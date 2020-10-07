<?php

namespace App\Core\Primitives;

class Time
{
	const Minutes = 'minutes';
	const Hours = 'hours';
	const Seconds = 'seconds';
	const Days = 'days';

	public function dmy ()
	{

	}

	public static function intervalToAbsoluteValue (\DateInterval $interval): float
	{
		return $interval->y . '.' . $interval->m;
	}

	public static function toSeconds (int $value, string $source = self::Minutes)
	{
		if ($source == self::Minutes)
			return $value * 60;
		elseif ($source == self::Hours)
			return $value * (60 * 60);
		elseif ($source == self::Days)
			return $value * (24 * 60 * 60);
		else
			return $value;
	}
}