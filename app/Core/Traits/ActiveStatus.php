<?php

namespace App\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ActiveStatus
{
	public static function active (): Builder
	{
		return self::query()->where('active', 1);
	}

	public static function inactive (): Builder
	{
		return self::query()->where('active', 0);
	}
}