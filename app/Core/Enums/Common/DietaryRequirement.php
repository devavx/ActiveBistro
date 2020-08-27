<?php


namespace App\Core\Enums\Common;


use BenSampo\Enum\Enum;

class DietaryRequirement extends Enum {
    const None = "none";
    const GlutenFree = "gluten_free";
    const Vegetarian = "vegetarian";
    const Vegan = "vegan";
}