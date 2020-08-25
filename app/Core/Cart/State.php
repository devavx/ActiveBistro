<?php

namespace App\Core\Cart;

use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Primitives\Arrays;
use App\Core\Primitives\Str;
use App\Item;
use App\MealPlan;
use App\Models\Cart;
use App\User;
use DeepCopy\DeepCopy;
use Illuminate\Contracts\Auth\Authenticatable;

class State
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
    private $items;

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
     * @var DeepCopy|null
     */
    private $cloner;

    /**
     * State constructor.
     * @param $user Authenticatable|User
     */
    public function __construct($user)
    {
        $exists = $this->createCartIfNotExists($user);
        if (!$exists) {
            $this->createBlankCards();
            $this->createBlankItems();
            $this->createBlankStats();
            $this->createDefaultOptions();
            $this->createSnapshot();
        } else {
            $this->loadSnapshot();
        }
        $this->cloner = new DeepCopy();
    }

    protected function createSnapshot(): void
    {
        MealPlan::classifyCards()->each(function (MealPlan $meal) {
            $day = $meal->day;
            $meal->prepare();
            $this->cards->$day[] = $meal;
        });
        foreach ($this->cards as $key => $value) {
            foreach ($value as $plan) {
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
        $state = [
            'options' => $this->options,
            'stats' => $this->stats,
            'cards' => $this->cards,
            'items' => $this->items
        ];
        $this->cart->update([
            'items' => $state
        ]);
    }

    protected function loadSnapshot(): void
    {
        $state = $this->cart->items;
        $this->options = $state->options ?? $this->createDefaultOptions();
        $this->cards = $state->cards ?? $this->createBlankCards();
        $this->stats = $state->stats ?? $this->createBlankStats();
        $this->items = $state->items ?? $this->createBlankItems();
        $this->resetStats();
        $this->calculateStats();
        $state = [
            'options' => $this->options,
            'stats' => $this->stats,
            'cards' => $this->cards,
            'items' => $this->items
        ];
        $this->cart->update([
            'items' => $state
        ]);
    }

    protected function createCartIfNotExists(User $user): bool
    {
        $exists = $user->cart()->exists();
        if (!$exists) {
            $this->cart = $user->cart()->create();
        } else {
            $this->cart = $user->cart;
        }
        return $exists;
    }

    protected function createBlankCards(): void
    {
        $this->cards = [];
        foreach (DaysOfWeek::getValues() as $value) {
            $this->cards[$value] = [];
        }
        $this->cards = (object)$this->cards;
    }

    protected function createBlankItems(): void
    {
        $this->items = [];
        foreach (DaysOfWeek::getValues() as $value) {
            $this->items[$value] = [];
        }
        $this->items = (object)$this->items;
    }

    protected function createBlankStats(): void
    {
        $this->stats = (object)[
            'carbohydrates' => 0,
            'fats' => 0,
            'proteins' => 0,
            'calories' => 0,
            'total' => 0
        ];
    }

    protected function createDefaultOptions(): void
    {
        $this->options = (object)[
            'allergies' => [],
            'weekends' => ['saturday' => false, 'sunday' => false],
            'breakfast' => false,
            'snacks' => false
        ];
    }

    public function addAllergy($allergy): int
    {
        if (!Arrays::contains($this->options['allergies'], $allergy)) {
            Arrays::push($this->options['allergies'], $allergy);
        }
        return count($this->options['allergies']);
    }

    public function removeAllergy($allergy): int
    {
        if (!Arrays::contains($this->options['allergies'], $allergy)) {
            Arrays::remove($this->options['allergies'], $allergy);
        }
        return count($this->options['allergies']);
    }

    public function allergies(): array
    {
        return $this->options['allergies'] ?? [];
    }

    public function cards(): object
    {
        return $this->cards ?? new \stdClass();
    }

    public function items(): object
    {
        return $this->items ?? new \stdClass();
    }

    public function card(string $day): array
    {
        return $this->cards->$day ?? [];
    }

    public function item(string $day): array
    {
        return $this->items->$day ?? [];
    }

    public function calories(): float
    {
        return $this->stats->calories ?? 0;
    }

    public function carbohydrates(): float
    {
        return $this->stats->carbohydrates ?? 0;
    }

    public function proteins(): float
    {
        return $this->stats->proteins ?? 0;
    }

    public function fats(): float
    {
        return $this->stats->fats ?? 0;
    }

    public function total(): float
    {
        return $this->stats->total ?? 0;
    }

    public function setCalories(float $calories): float
    {
        $this->stats->calories = $calories;
        return $this->stats->calories;
    }

    public function setCarbohydrates(float $carbohydrates): float
    {
        $this->stats->carbohydrates = $carbohydrates;
        return $this->stats->carbohydrates;
    }

    public function setProteins(float $proteins): float
    {
        $this->stats->proteins = $proteins;
        return $this->stats->proteins;
    }

    public function setFats(float $fats): float
    {
        $this->stats->fats = $fats;
        return $this->stats->fats;
    }

    public function setTotal(float $total): float
    {
        $this->stats->total = $total;
        return $this->stats->total;
    }

    public function resetStats(): void
    {
        $this->createBlankStats();
    }

    public function calculateStats()
    {
        foreach ($this->cards as $key => $value) {
            foreach ($value as $plan) {
                $plan->total = 0;
                foreach ($plan->items as $item) {
                    if ($item->chosen == true) {
                        $this->setCarbohydrates($this->carbohydrates() + ($item->carbs * $plan->quantity ?? 1));
                        $this->setCalories($this->calories() + ($item->calories * $plan->quantity ?? 1));
                        $this->setProteins($this->proteins() + ($item->protein * $plan->quantity ?? 1));
                        $this->setFats($this->fats() + ($item->fat * $plan->quantity ?? 1));
                        $plan->total += floatval($item->selling_price);
                    }
                }
                $plan->total = $plan->total * $plan->quantity;
                $this->setTotal($this->total() + $plan->total);
            }
        }
        foreach ($this->items as $key => $value) {
            foreach ($value as $item) {
                $item->total = 0;
                $this->setCarbohydrates($this->carbohydrates() + ($item->carbs * $item->quantity ?? 1));
                $this->setCalories($this->calories() + ($item->calories * $item->quantity ?? 1));
                $this->setProteins($this->proteins() + ($item->protein * $item->quantity ?? 1));
                $this->setFats($this->fats() + ($item->fat * $item->quantity ?? 1));
                $item->total = floatval($item->selling_price) * $item->quantity;
                $this->setTotal($this->total() + $item->total);
            }
        }
    }

    public function recalculateStats()
    {
        $this->resetStats();
        $this->calculateStats();
    }

    public function update()
    {
        $state = [
            'options' => $this->options,
            'stats' => $this->stats,
            'cards' => $this->cards,
            'items' => $this->items
        ];
        $this->cart->update([
            'items' => $state
        ]);
    }

    public function increaseQuantity(string $day, string $mealPlanKey)
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

    public function cloneMealPlan(string $day, string $mealPlanKey)
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

    public function deleteMealPlan(string $day, string $mealPlanKey)
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

    public function duplicatePlan(string $day, string $mealPlanKey)
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

    public function decreaseQuantity(string $day, string $mealPlanKey)
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

    public function replaceItem(string $day, string $mealPlanKey, int $slab, int $itemId)
    {
        $meals = $this->card($day);
        foreach ($meals as $meal) {
            if ($meal->uuid == $mealPlanKey) {
                foreach ($meal->items as $item) {
                    if ($item->slab == $slab && $item->chosen == true) {
                        $item->chosen = false;
                    } elseif ($item->slab == $slab && $item->id == $itemId) {
                        $item->chosen = true;
                    }
                }
                $this->recalculateStats();
                $this->update();
                break;
            }
        }
    }

    public function addItem(string $day, int $itemId)
    {
        $items = $this->item($day);
        foreach ($items as $item) {
            if ($item->id == $itemId) {
                $item->quantity += 1;
                $this->recalculateStats();
                $this->update();
                return;
            }
        }
        $item = Item::find($itemId);
        $item->quantity = 1;
        $item->total = $item->selling_price;
        $item->uuid = Str::uuid()->toString();
        $items[] = $item;
        $this->items->$day = $items;
        $this->recalculateStats();
        $this->update();
    }

    public function removeItem(string $day, int $itemId)
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

    public function deleteItem(string $day, int $itemId)
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
}