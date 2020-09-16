<?php

namespace App\Core\Enums\Common;

use BenSampo\Enum\Enum;

final class ActivityLevel extends Enum
{
	const None = -1;
	const Sedentary = 1;
	const Light = 2;
	const Moderate = 3;
	const Very = 4;
	const Extra = 5;
	const Athlete = 6;
}