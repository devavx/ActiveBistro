<?php


namespace App\Core\Primitives;


class Str extends \Illuminate\Support\Str
{
	const Empty = '';
	const Root = '';
	const Create = 'create';
	const Edit = '{key}/edit';

	public static function placeholder (?string $value, ?string $placeholder = '<N/A>'): ?string
	{
		if ($value != null && strlen($value) > 0)
			return $value;
		else
			return $placeholder;
	}
}