<?php

namespace App\Core\Enums\Common;

use BenSampo\Enum\Enum;

class DaysOfWeek extends Enum
{
	const Monday = 'monday';
	const Tuesday = 'tuesday';
	const Wednesday = 'wednesday';
	const Thursday = 'thursday';
	const Friday = 'friday';
	const Saturday = 'saturday';
	const Sunday = 'sunday';

	/**
	 * You can manipulate this sequence to control the order
	 * in which days and their respective meals are listed.
	 * Default order is the sequence in which the const values are defined.
	 * @return array
	 */
	public static function sequence (): array
	{
		return [
			self::Monday,
			self::Tuesday,
			self::Wednesday,
			self::Thursday,
			self::Friday,
			self::Saturday,
			self::Sunday
		];
	}
}