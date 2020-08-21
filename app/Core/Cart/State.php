<?php

namespace App\Core\Cart;

use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Primitives\Arrays;
use App\MealPlan;
use App\Models\Cart;
use App\User;
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
     * State constructor.
     * @param $user Authenticatable|User
     */
    public function __construct($user)
    {
        $exists = $this->createCartIfNotExists($user);
        if (!$exists) {
            $this->createBlankCards();
            $this->createBlankStats();
            $this->createDefaultOptions();
            $this->createSnapshot();
        } else {
            $this->loadSnapshot();
        }
    }

    protected function createSnapshot(): void
    {
        $meals = MealPlan::with('items')->whereNotNull('day')->where('active', 1)->get();
        $meals->each(function (MealPlan $meal) {
            $meal->quantity = 1;
            $meal->total = 0;
            $day = $meal->day;
            $this->cards->$day[] = $meal;
        });
        foreach ($this->cards as $key => $value) {
            foreach ($value as $plan) {
                foreach ($plan->items as $item) {
                    $item->chosen = $item->pivot->default;
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
            'cards' => $this->cards
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
        $this->resetStats();
        $this->calculateStats();
        $state = [
            'options' => $this->options,
            'stats' => $this->stats,
            'cards' => $this->cards
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

    public function card(string $day): array
    {
        return $this->cards->$day ?? [];
    }

    public function sunday(): array
    {
        return $this->cards[DaysOfWeek::Sunday] ?? [];
    }

    public function monday(): array
    {
        return $this->cards[DaysOfWeek::Monday] ?? [];
    }

    public function tuesday(): array
    {
        return $this->cards[DaysOfWeek::Tuesday] ?? [];
    }

    public function wednesday(): array
    {
        return $this->cards[DaysOfWeek::Wednesday] ?? [];
    }

    public function thursday(): array
    {
        return $this->cards[DaysOfWeek::Thursday] ?? [];
    }

    public function friday(): array
    {
        return $this->cards[DaysOfWeek::Friday] ?? [];
    }

    public function saturday(): array
    {
        return $this->cards[DaysOfWeek::Saturday] ?? [];
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
            'cards' => $this->cards
        ];
        $this->cart->update([
            'items' => $state
        ]);
    }

    public function increaseQuantity(string $day, int $mealPlanKey)
    {
        $meals = $this->card($day);
        foreach ($meals as $meal) {
            if ($meal->id == $mealPlanKey) {
                if ($meal->quantity < self::MaxQuantity) {
                    $meal->quantity += 1;
                    $this->recalculateStats();
                    $this->update();
                    break;
                }
            }
        }
    }

    public function decreaseQuantity(string $day, int $mealPlanKey)
    {
        $meals = $this->card($day);
        foreach ($meals as $meal) {
            if ($meal->id == $mealPlanKey) {
                if ($meal->quantity >= self::MinQuantity) {
                    $meal->quantity -= 1;
                    $this->recalculateStats();
                    $this->update();
                    break;
                }
            }
        }
    }

    public function replaceItem(string $day, int $mealPlanKey, int $slab, int $itemId)
    {
        $meals = $this->card($day);
        foreach ($meals as $meal) {
            if ($meal->id == $mealPlanKey) {
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
}