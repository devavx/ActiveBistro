<?php

namespace App\Core\Enums\Common;

use BenSampo\Enum\Enum;

class DietaryRequirement extends Enum
{
	const None = "none";
	const GlutenFree = "gluten_free";
	const Vegetarian = "vegetarian";
	const Vegan = "vegan";
	protected const Names = [
		self::None => "None",
		self::GlutenFree => "Gluten Free",
		self::Vegetarian => "Vegetarian",
		self::Vegan => "Vegan",
	];

	public static function displayName (string $key): ?string
	{
		return self::Names[$key];
	}
}