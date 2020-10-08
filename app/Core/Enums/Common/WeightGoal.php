<?php

namespace App\Core\Enums\Common;

use BenSampo\Enum\Enum;

class WeightGoal extends Enum
{
	const Lose = 'lose';
	const Gain = 'gain';
	const Maintain = 'maintain';
}