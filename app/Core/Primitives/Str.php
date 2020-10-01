<?php

namespace App\Core\Primitives;

class Str extends \Illuminate\Support\Str
{
	const Empty = '';
	const Root = '';
	const Create = 'create';
	const Edit = '{id}/edit';
	const Update = '{id}/update';

	public static function placeholder (?string $value, ?string $placeholder = '<N/A>'): ?string
	{
		if ($value != null && strlen($value) > 0)
			return $value;
		else
			return $placeholder;
	}

	public static function ellipsis (string $value, $length = 50): ?string
	{
		return mb_strimwidth($value, 0, $length, "...");
	}
}