<?php

namespace App\Core\Primitives;

use Illuminate\Support\Arr;

class Arrays extends Arr
{
	/**
	 * Checks whether an array contains an item.
	 *
	 * @param array $haystack The array to search into
	 * @param $needle mixed Value to search for
	 * @param bool $associative True if the haystack is an associative array
	 * @return bool true if item is found, false otherwise
	 */
	public static function contains (array $haystack, $needle, bool $associative = false): bool
	{
		if (!$associative)
			foreach ($haystack as $value) {
				if ($value == $needle)
					return true;
			}
		else
			foreach ($haystack as $key => $value) {
				if ($value == $needle)
					return true;
			}
		return false;
	}

	/**
	 * Checks whether an array contains an item.
	 *
	 * @param array $haystack The array to search into
	 * @param $needle mixed Value to search for
	 */
	public static function remove (array &$haystack, $needle): void
	{
		$index = 0;
		foreach ($haystack as $value) {
			if ($value == $needle) {
				unset($haystack[$index]);
				$haystack = array_values($haystack);
				break;
			}
			$index++;
		}
	}

	public static function push (&$array, $item = null): int
	{
		return array_push($array, $item);
	}

	public static function pairsOf (array $source, int $pairsOf)
	{
		if ($pairsOf >= 1)
			return array_chunk($source, $pairsOf);
		else
			return $source;
	}
}