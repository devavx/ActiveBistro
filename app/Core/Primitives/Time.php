<?php

namespace App\Core\Primitives;

class Time
{
	public function dmy ()
	{

	}

	public static function intervalToAbsoluteValue (\DateInterval $interval): float
	{
		return $interval->y . '.' . $interval->m;
	}
}