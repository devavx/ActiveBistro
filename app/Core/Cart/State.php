<?php

namespace App\Core\Cart;

use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Enums\Common\DietaryRequirement;
use App\Core\Enums\Common\MealTypes;
use App\Core\Enums\Common\PaymentSlab;
use App\Core\Primitives\Arrays;
use App\Core\Primitives\Str;
use App\Exceptions\InvalidCouponException;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\MealPlan;
use App\Models\User;
use DeepCopy\DeepCopy;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class State
{
	/**
	 * Maximum quantity of a meal plan in the cart.
	 */
	const MaxQuantity = 10;

	/**
	 * Minimum quantity of a meal plan in the cart.
	 */
	const MinQuantity = 2;

	/**
	 * @var \stdClass
	 */
	private $cards;

	/**
	 * @var \stdClass
	 */
	private $stats;

	/**
	 * @var \stdClass
	 */
	private $options;

	/**
	 * @var Cart|null
	 */
	private $cart;

	/**
	 * @var Coupon|null
	 */
	private $coupon;

	/**
	 * @var DeepCopy|null
	 */
	private $cloner;

	/**
	 * State constructor.
	 * @param $user User|Authenticatable
	 * @param Options|null $options
	 */
	public function __construct ($user, Options $options = null)
	{
		$exists = $this->createCartIfNotExists($user);
		if (!$exists) {
			$this->createDefaultOptions($options);
			$this->createBlankCards();
			$this->createBlankStats();
			$this->createSnapshot();
		} else {
			$this->loadSnapshot();
		}
		$this->cloner = new DeepCopy();
	}

	public function calculateStats ()
	{
		foreach ($this->cards as $key => $value) {
			foreach ($value as $plan) {
				$plan->total = 0;
				foreach ($plan->items as $item) {
					if (!isset($item->chosen)) $item->chosen = $item->pivot->default == 1 || $item->pivot->default == true;
					if (!isset($item->slab)) $item->slab = $item->pivot->slab;
					if ($item->chosen == true) {
						$this->setCarbohydrates($this->carbohydrates() + ($item->carbs * $plan->quantity ?? 1));
						$this->setCalories($this->calories() + ($item->calories * $plan->quantity ?? 1));
						$this->setProteins($this->proteins() + ($item->protein * $plan->quantity ?? 1));
						$this->setFats($this->fats() + ($item->fat * $plan->quantity ?? 1));
						$plan->total += floatval($item->selling_price);
					}
				}
				$plan->total = $plan->total * $plan->quantity;
				$this->setSubTotal($this->subTotal() + $plan->total);
			}
		}
		$this->setTotal($this->subTotal());
		if ($this->discount() > 0 && $this->total() > 0) {
			$total = $this->total();
			$rebate = ($this->discount() / 100.0) * $total;
			$this->setTotal($total - $rebate);
		}
		if ($this->coupon() != null && $this->total() > 0) {
			$coupon = $this->coupon();
			if ($coupon->type == Coupon::Flat) {
				$this->calculateFlatDiscount();
			} else {
				$this->calculatePercentDiscount();
			}
		}
	}

	protected function query (): Builder
	{
		return MealPlan::query()->with('items', 'allergies')->whereNotNull('day')->where('active', 1)->where('launched', 1);
	}

	protected function createSnapshot (): void
	{
		$this->query()->each(function (MealPlan $meal) {
			$day = $meal->day;
			$meal->prepare();
			$items = $this->cards->$day;
			if ($this->getMealsPerDay() > count($items)) {
				if (!empty($meal->type)) {
					if ($meal->type == MealTypes::Breakfast && $this->wantBreakfast()) {
						Arrays::push($this->cards->$day, $meal);
					} elseif ($meal->type == MealTypes::Snacks && $this->wantSnacks()) {
						Arrays::push($this->cards->$day, $meal);
					}
				} else {
					Arrays::push($this->cards->$day, $meal);
				}
			}
		});
		if (!$this->getMealsAtSunday()) {
			$this->cards->sunday = [];
		}
		if (!$this->getMealsAtSaturday()) {
			$this->cards->saturday = [];
		}
		foreach ($this->cards as $key => $value) {
			foreach ($value as $plan) {
				foreach ($plan->allergies->pluck('id')->toArray() as $allergyId) {
					$plan->allergic = $this->isAllergicTo($allergyId);
				}
				foreach ($plan->items as $item) {
					$item->prepare();
					$item->chosen = $item->pivot->default == 1 || $item->pivot->default == true;
					$item->slab = $item->pivot->slab;
					if ($item->pivot->default == true) {
						$this->setCarbohydrates($this->carbohydrates() + $item->carbs);
						$this->setCalories($this->calories() + $item->calories);
						$this->setProteins($this->proteins() + $item->protein);
						$this->setFats($this->fats() + $item->fat);
						$plan->total += floatval($item->selling_price);
					}
				}
				$plan->total = $plan->total * $plan->quantity;
				$this->setTotal($this->total() + $plan->total);
			}
		}
		if ($this->discount() > 0) {
			$total = $this->total();
			$rebate = ($this->discount() / 100.0) * $total;
			$this->setSubTotal($total);
			$this->setTotal($total - $rebate);
		}
		$this->update();
	}

	protected function loadSnapshot (): void
	{
		$this->loadCouponIfExists();
		$this->loadOptions();
		$this->cards = $this->cart()->items;
		$this->loadStats();
		$this->resetStats();
		$this->calculateStats();
		$this->update();
	}

	protected function loadCouponIfExists (): bool
	{
		$coupon = $this->cart()->coupon;
		if ($coupon != null && $coupon->isValid()) {
			$this->coupon = $coupon;
		}
		return $coupon == null;
	}

	protected function createCartIfNotExists (User $user): bool
	{
		$exists = $user->cart()->exists();
		if (!$exists) {
			$this->cart = $user->cart()->create();
		} else {
			$this->cart = $user->cart;
		}
		return $exists;
	}

	protected function createBlankCards (): void
	{
		$this->cards = [];
		foreach (DaysOfWeek::sequence() as $value) {
			$this->cards[$value] = [];
		}
		$this->cards = (object)$this->cards;
	}

	protected function createBlankStats (): void
	{
		$this->stats = (object)[
			'carbohydrates' => 0,
			'fats' => 0,
			'proteins' => 0,
			'calories' => 0,
			'total' => 0,
			'subTotal' => 0,
			'discount' => 0,
			'staffDiscount' => false,
			'firstDate' => null,
			'secondDate' => null
		];
	}

	protected function loadStats (): void
	{
		$this->stats = (object)[
			'carbohydrates' => $this->cart()->carbohydrates,
			'fats' => $this->cart()->fats,
			'proteins' => $this->cart()->proteins,
			'calories' => $this->cart()->calories,
			'staffDiscount' => $this->cart()->staffDiscount,
			'discount' => $this->cart()->discount,
			'total' => $this->cart()->total,
			'subTotal' => $this->cart()->subTotal,
			'firstDate' => $this->cart()->firstDate,
			'secondDate' => $this->cart()->secondDate,
		];
	}

	protected function createDefaultOptions (Options $options = null): void
	{
		if ($options == null) {
			$options = new Options();
		}
		$this->options = (object)[
			'allergies' => $options->getAllergies(),
			'weekends' => $options->getMealsAtWeekends(),
			'breakfast' => $options->wantBreakfast(),
			'snacks' => $options->wantSnacks(),
			'snackCount' => $options->getSnacksPerDay(),
			'mealsPerDay' => $options->getMealsPerDay(),
			'dietary_requirement' => $options->getDietaryRequirement()
		];
	}

	protected function loadOptions (): void
	{
		$this->options = (object)[
			'allergies' => $this->cart()->allergies,
			'weekends' => $this->cart()->weekendMeals,
			'breakfast' => $this->cart()->wantBreakfast,
			'snacks' => $this->cart()->wantSnacks,
			'snackCount' => $this->cart()->snackCount,
			'mealsPerDay' => $this->cart()->mealsPerDay,
			'dietary_requirement' => $this->cart()->dietaryRequirement
		];
	}

	public function addAllergy ($allergy): int
	{
		if (!Arrays::contains($this->options->allergies, $allergy)) {
			Arrays::push($this->options->allergies, $allergy);
		}
		return count($this->options->allergies);
	}

	public function removeAllergy ($allergy): int
	{
		if (!Arrays::contains($this->options->allergies, $allergy)) {
			Arrays::remove($this->options->allergies, $allergy);
		}
		return count($this->options->allergies);
	}

	public function allergies (): array
	{
		return $this->options->allergies ?? [];
	}

	public function cards (): \stdClass
	{
		return $this->cards ?? new \stdClass();
	}

	public function card (string $day): array
	{
		return $this->cards->$day ?? [];
	}

	public function cart (): Cart
	{
		return $this->cart;
	}

	public function calories (): float
	{
		return $this->stats->calories ?? 0;
	}

	public function carbohydrates (): float
	{
		return $this->stats->carbohydrates ?? 0;
	}

	public function proteins (): float
	{
		return $this->stats->proteins ?? 0;
	}

	public function fats (): float
	{
		return $this->stats->fats ?? 0;
	}

	public function total (): float
	{
		return $this->stats->total ?? 0;
	}

	public function subTotal (): float
	{
		return $this->stats->subTotal ?? 0;
	}

	public function discount (): float
	{
		$discount = 0.0;
		if ($this->staffDiscount())
			$discount += 25.0;
		return $discount;
	}

	public function paymentSlab (): string
	{
		return $this->stats->paymentSlab ?? PaymentSlab::Weekly;
	}

	public function firstDate (): ?string
	{
		return $this->stats->firstDate;
	}

	public function secondDate (): ?string
	{
		return $this->stats->secondDate;
	}

	public function staffDiscount (): bool
	{
		return $this->stats->staffDiscount ?? false;
	}

	public function setCalories (float $calories): float
	{
		$this->stats->calories = $calories;
		return $this->stats->calories;
	}

	public function setCarbohydrates (float $carbohydrates): float
	{
		$this->stats->carbohydrates = $carbohydrates;
		return $this->stats->carbohydrates;
	}

	public function setProteins (float $proteins): float
	{
		$this->stats->proteins = $proteins;
		return $this->stats->proteins;
	}

	public function setFats (float $fats): float
	{
		$this->stats->fats = $fats;
		return $this->stats->fats;
	}

	public function setTotal (float $total): float
	{
		$this->stats->total = $total;
		return $this->stats->total;
	}

	public function setSubTotal (float $subTotal): float
	{
		$this->stats->subTotal = $subTotal;
		return $this->stats->subTotal;
	}

	public function setDiscount (float $discount, $type = 'percent'): float
	{
		$this->stats->discount = $discount;
		return $this->stats->discount;
	}

	public function setStaffDiscount (bool $allow): bool
	{
		$this->stats->staffDiscount = $allow;
		return $this->stats->staffDiscount;
	}

	public function setPaymentSlab (PaymentSlab $paymentSlab)
	{
		$this->stats->paymentSlab = $paymentSlab->value;
		return $this->stats->paymentSlab;
	}

	public function setFirstDate (string $date): ?string
	{
		$this->stats->firstDate = $date;
		return $this->stats->firstDate;
	}

	public function setSecondDate (string $date): ?string
	{
		$this->stats->secondDate = $date;
		return $this->stats->secondDate;
	}

	public function resetStats (): void
	{
		$this->createBlankStats();
	}

	public function recalculateStats ()
	{
		$this->resetStats();
		$this->calculateStats();
	}

	public function update ()
	{
		$payload = [
			'calories' => $this->calories(),
			'fats' => $this->fats(),
			'proteins' => $this->proteins(),
			'carbohydrates' => $this->carbohydrates(),
			'wantBreakfast' => $this->wantBreakfast(),
			'wantSnacks' => $this->wantSnacks(),
			'weekendMeals' => $this->weekendMeals(),
			'snackCount' => $this->snackCount(),
			'mealsPerDay' => $this->getMealsPerDay(),
			'dietaryRequirement' => $this->getDietaryRequirement(),
			'allergies' => $this->allergies(),
			'items' => $this->cards(),
			'discount' => $this->discount(),
			'subTotal' => $this->subTotal(),
			'total' => $this->total(),
			'firstDate' => $this->firstDate(),
			'secondDate' => $this->secondDate(),
		];
		if ($this->coupon() != null) {
			$payload['coupon_code'] = $this->coupon()->code;
			$payload['coupon_id'] = $this->coupon()->getKey();
		} else {
			$payload['coupon_code'] = null;
			$payload['coupon_id'] = null;
		}
		$this->cart->update($payload);
	}

	public function increaseQuantity (string $day, string $mealPlanKey)
	{
		$meals = $this->card($day);
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				if ($meal->quantity < self::MaxQuantity) {
					$meal->quantity += 1;
					$this->recalculateStats();
					$this->update();
					break;
				}
			}
		}
	}

	public function cloneMealPlan (string $day, string $mealPlanKey)
	{
		$meals = $this->card($day);
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				$clone = $this->cloner->copy($meal);
				$clone->uuid = Str::uuid()->toString();
				$meals[] = $clone;
				$this->cards->$day = $meals;
				$this->recalculateStats();
				$this->update();
				break;
			}
		}
	}

	public function deleteMealPlan (string $day, string $mealPlanKey)
	{
		$meals = $this->card($day);
		$index = 0;
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				unset($meals[$index]);
				$meals = array_values($meals);
				$this->cards->$day = $meals;
				$this->recalculateStats();
				$this->update();
				break;
			}
			$index++;
		}
	}

	public function duplicatePlan (string $day, string $mealPlanKey)
	{
		$meals = $this->card($day);
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				if ($meal->quantity < self::MaxQuantity) {
					$meal->quantity += 1;
					$this->recalculateStats();
					$this->update();
					break;
				}
			}
		}
	}

	public function decreaseQuantity (string $day, string $mealPlanKey)
	{
		$meals = $this->card($day);
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				if ($meal->quantity >= self::MinQuantity) {
					$meal->quantity -= 1;
					$this->recalculateStats();
					$this->update();
					break;
				}
			}
		}
	}

	public function replaceItem (string $day, string $mealPlanKey, int $slab, int $itemId)
	{
		$meals = $this->card($day);
		foreach ($meals as $meal) {
			if ($meal->uuid == $mealPlanKey) {
				foreach ($meal->items as $item) {
					if ($item->slab == $slab) {
						$item->chosen = false;
					}
				}
				foreach ($meal->items as $item) {
					if ($item->id == $itemId) {
						$item->chosen = true;
					}
				}
				$this->recalculateStats();
				$this->update();
				break;
			}
		}
	}

	public function addItem (string $day, int $itemId)
	{
		$items = $this->card($day);
		foreach ($items as $item) {
			if ($item->id == $itemId) {
				$item->quantity += 1;
				$this->recalculateStats();
				$this->update();
				return;
			}
		}
		$item = MealPlan::query()->with('items')->whereKey($itemId)->first();
		$item->prepare();
		$items[] = $item;
		$this->cards->$day = $items;
		$this->recalculateStats();
		$this->update();
	}

	public function removeItem (string $day, int $itemId)
	{
		$items = $this->item($day);
		$index = 0;
		foreach ($items as $item) {
			if ($item->id == $itemId) {
				if ($item->quantity <= 1) {
					unset($items[$index]);
					$items = array_values($items);
					$this->items->$day = $items;
				} else {
					$item->quantity -= 1;
				}
				$this->recalculateStats();
				$this->update();
				return;
			}
			$index++;
		}
	}

	public function deleteItem (string $day, int $itemId)
	{
		$items = $this->item($day);
		$index = 0;
		foreach ($items as $item) {
			if ($item->id == $itemId) {
				unset($items[$index]);
				$items = array_values($items);
				$this->items->$day = $items;
				$this->recalculateStats();
				$this->update();
				return;
			}
			$index++;
		}
	}

	public function setMealsPerDay (int $mealsPerDay): void
	{
		$this->options->mealsPerDay = $mealsPerDay;
	}

	public function getMealsPerDay (): int
	{
		return $this->options->mealsPerDay ?? 6;
	}

	public function setMealsAtWeekends (bool $enable): void
	{
		$this->options->weekends->sunday = $enable;
		$this->options->weekends->saturday = $enable;
	}

	public function getMealsAtSunday (): bool
	{
		return $this->options->weekends->sunday ?? false;
	}

	public function getMealsAtSaturday (): bool
	{
		return $this->options->weekends->saturday ?? false;
	}

	public function setDietaryRequirement (string $dietaryRequirement): void
	{
		$this->options->dietary_requirement = $dietaryRequirement;
	}

	public function wantBreakfast (): bool
	{
		return $this->options->breakfast ?? false;
	}

	public function wantSnacks (): bool
	{
		return $this->options->snacks ?? false;
	}

	public function weekendMeals (): bool
	{
		return $this->getMealsAtSunday() && $this->getMealsAtSaturday();
	}

	public function snackCount (): int
	{
		return $this->options->snackCount ?? 0;
	}

	public function getDietaryRequirement (): string
	{
		return $this->options->dietary_requirement ?? DietaryRequirement::None;
	}

	public function items (callable $callback = null): array
	{
		$items = [];
		foreach ($this->cards() as $key => $value) {
			foreach ($value as $item) {
				$items[] = $this->transformItem($item, $callback);
			}
		}
		return $items;
	}

	protected function transformItem (\stdClass $item, callable $callback = null): array
	{
		if ($callback != null) {
			return call_user_func($callback, $item);
		}
		$subItems = [];
		foreach ($item->items as $subItem) {
			$subItems[] = $subItem->name;
		}
		$subItems = implode(", ", $subItems);
		$subItems = 'Items: ' . $subItems;
		return [
			'name' => $item->name,
			'price' => $item->total,
			'desc' => $subItems,
			'qty' => $item->quantity
		];
	}

	public function invoice (): \stdClass
	{
		$id = strtoupper(substr(md5($this->cart()->getKey()), 0, 10));
		$description = "Order_{$id}";
		return (object)[
			'id' => $id,
			'description' => $description
		];
	}

	public function meals (): Collection
	{
		$collection = new Collection();
		foreach ($this->cards() as $day => $meals) {
			foreach ($meals as $meal) {
				$collection->push($meal);
			}
		}
		return $collection;
	}

	public function isAllergicTo ($allergyId): bool
	{
		foreach ($this->allergies() as $allergy) {
			if ($allergyId == intval($allergy)) {
				return true;
			}
		}
		return false;
	}

	public function setCoupon (?Coupon $coupon): void
	{
		if ($coupon != null) {
			if ($coupon->isValid())
				$this->coupon = $coupon;
			else
				throw new InvalidCouponException();
		} else {
			$this->coupon = $coupon;
		}
	}

	public function coupon (): ?Coupon
	{
		return $this->coupon;
	}

	protected function calculateFlatDiscount ()
	{
		$coupon = $this->coupon();
		$subTotal = $this->subTotal();
		if ($coupon->discount > $subTotal) {
			$this->setTotal(0.0);
		} else {
			$this->setTotal($subTotal - $coupon->discount);
		}
	}

	protected function calculatePercentDiscount ()
	{
		$coupon = $this->coupon();
		$subTotal = $this->subTotal();
		$value = ($coupon->discount / 100.0) * $subTotal;
		if ($value > $subTotal) {
			$this->setTotal(0.0);
		} else {
			$this->setTotal($subTotal - $value);
		}
	}
}