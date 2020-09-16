<?php

namespace App\Core\Cart;

use App\Core\Enums\Common\DietaryRequirement;

final class Options
{
	/**
	 * @var array
	 */
	protected $allergies;

	/**
	 * @var \stdClass
	 */
	protected $mealsAtWeekends;

	/**
	 * @var bool
	 */
	protected $breakfast;

	/**
	 * @var bool
	 */
	protected $snacks;

	/**
	 * @var integer
	 */
	protected $mealsPerDay;

	/**
	 * @var string
	 */
	protected $dietaryRequirement;

	public function __construct ()
	{
		$this->allergies = [];
		$this->mealsAtWeekends = (object)['saturday' => false, 'sunday' => false];
		$this->breakfast = false;
		$this->snacks = false;
		$this->mealsPerDay = 0;
		$this->dietaryRequirement = DietaryRequirement::None;
	}

	/**
	 * @return array
	 */
	public function getAllergies (): array
	{
		return $this->allergies;
	}

	/**
	 * @param array $allergies
	 * @return Options
	 */
	public function setAllergies (array $allergies): Options
	{
		$this->allergies = $allergies;
		return $this;
	}

	/**
	 * @return \stdClass
	 */
	public function getMealsAtWeekends (): \stdClass
	{
		return $this->mealsAtWeekends;
	}

	/**
	 * @param \stdClass $mealsAtWeekends
	 * @return Options
	 */
	public function setMealsAtWeekends (\stdClass $mealsAtWeekends): Options
	{
		$this->mealsAtWeekends = $mealsAtWeekends;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function wantBreakfast (): bool
	{
		return $this->breakfast;
	}

	/**
	 * @param bool $want
	 * @return Options
	 */
	public function setWantBreakfast (bool $want): Options
	{
		$this->breakfast = $want;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function wantSnacks (): bool
	{
		return $this->snacks;
	}

	/**
	 * @param bool $want
	 * @return Options
	 */
	public function setWantSnacks (bool $want): Options
	{
		$this->snacks = $want;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMealsPerDay (): int
	{
		return $this->mealsPerDay;
	}

	/**
	 * @param int $mealsPerDay
	 * @return Options
	 */
	public function setMealsPerDay (int $mealsPerDay): Options
	{
		$this->mealsPerDay = $mealsPerDay;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDietaryRequirement (): string
	{
		return $this->dietaryRequirement;
	}

	/**
	 * @param string $dietaryRequirement
	 * @return Options
	 */
	public function setDietaryRequirement (string $dietaryRequirement): Options
	{
		$this->dietaryRequirement = $dietaryRequirement;
		return $this;
	}
}