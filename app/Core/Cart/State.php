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
     * @var array
     */
    private $cards;

    /**
     * @var array
     */
    private $stats;

    /**
     * @var array
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
            $this->setCarbohydrates($this->carbohydrates() + $meal->items()->sum('carbs'));
            $this->setCalories($this->calories() + $meal->items()->sum('calories'));
            $this->setProteins($this->proteins() + $meal->items()->sum('protein'));
            $this->setFats($this->fats() + $meal->items()->sum('fat'));
            Arrays::push($this->cards[$meal->day], (object)[
                'meal' => $meal->toArray(),
                'items' => $meal->items->toArray(),
            ]);
        });
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
        $state['options'] = $state['options'] ?? $this->createDefaultOptions();
        $state['cards'] = $state['cards'] ?? $this->createBlankCards();
        $state['stats'] = $state['stats'] ?? $this->createBlankStats();
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
    }

    protected function createBlankStats(): void
    {
        $this->stats = [
            'carbohydrates' => 0,
            'fats' => 0,
            'proteins' => 0,
            'calories' => 0
        ];
    }

    protected function createDefaultOptions(): void
    {
        $this->options = [
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

    public function cards(): array
    {
        return $this->cards ?? [];
    }

    public function card(string $day): array
    {
        return $this->cards[$day] ?? [];
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
        return $this->stats['calories'] ?? 0;
    }

    public function carbohydrates(): float
    {
        return $this->stats['carbohydrates'] ?? 0;
    }

    public function proteins(): float
    {
        return $this->stats['proteins'] ?? 0;
    }

    public function fats(): float
    {
        return $this->stats['fats'] ?? 0;
    }

    public function setCalories(float $calories): float
    {
        $this->stats['calories'] = $calories;
        return $this->stats['calories'];
    }

    public function setCarbohydrates(float $carbohydrates): float
    {
        $this->stats['carbohydrates'] = $carbohydrates;
        return $this->stats['carbohydrates'];
    }

    public function setProteins(float $proteins): float
    {
        $this->stats['proteins'] = $proteins;
        return $this->stats['proteins'];
    }

    public function setFats(float $fats): float
    {
        $this->stats['fats'] = $fats;
        return $this->stats['fats'];
    }

    public function resetStats(): void
    {
        $this->createBlankStats();
    }
}