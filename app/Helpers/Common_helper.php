<?php
/**
 * Maximum length of a file path.
 * Global - change here to reflect everywhere.
 */

use App\Core\Primitives\Time;
use App\Models\DeliveryDeadline;
use Illuminate\Support\Carbon;

const MaxFilePath = 1024;

function changeDateFormat ($date, $format)
{
	try {
		return \Carbon\Carbon::parse($date)->format($format);
	} catch (Exception $e) {
		return false;
	}

	// DateTime::createFromFormat($from, $date)->format($to);
}

function changeTimeFormat ($time, $format)
{
	try {
		return \Carbon\Carbon::parse($time)->format($format);
	} catch (Exception $e) {
		return false;
	}

}

function timeFormat24To12 ($time = '')
{
	try {
		return date("g:i a", strtotime($time));;
	} catch (Exception $e) {
		return false;
	}
}

function getAllItemList ()
{
	try {
		$catList = \App\Models\Item::all();
	} catch (Exception $e) {
		$catList = [];
	}
	return $catList;

}

function getAllUserList ()
{
	try {
		$userList = \App\Models\User::all();
	} catch (Exception $e) {
		$userList = [];
	}
	return $userList;
}

function getAge ($date1 = '', $date2 = '')
{
	// $date1 = "2007-03-24";
	// $date2 = "2009-06-26";
	try {
		$diff = abs(strtotime($date2) - strtotime($date1));

		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
	} catch (Exception $e) {
		$years = 1;
	}

	return $years;
}

function getCalories ($gender = '', $weightInKG = '', $heighIntCM = '', $age = '')
{
	if ($gender == 'male') {

		try {
			$calo = (99.99 * $weightInKG) + (6.25 * $heighIntCM) - (4.92 * $age + 5);
		} catch (Exception $e) {
			$calo = $e;
		}
	} else {
		try {
			$calo = (99.99 * $weightInKG) + (6.25 * $heighIntCM) - (4.92 * $age - 161);
		} catch (Exception $e) {
			$calo = $e;
		}
	}
	return $calo;
}

function percentOf ($value, $percent): float
{
	return ($percent / 100.0) * $value;
}

function elapsed (): ?string
{
	$deadline = deadline();
	if ($deadline == null) {
		return 0;
	} else {
//		return strtotime($deadline->deadline);
		return \time();
	}
}

function deadline ()
{
	return DeliveryDeadline::query()->first();
}

function dates (): array
{
	$dates = [];
	$nextWednesday = strtotime('next wednesday');
	$nextSunday = strtotime('next sunday');
	$threeDays = Time::toSeconds(3, Time::Days);
	$fourDays = Time::toSeconds(4, Time::Days);
	$isFriday = Carbon::now()->isFriday();
	$isMonday = Carbon::now()->isMonday();
	$current = \time();
	// We have an upcoming Sunday closer than Wednesday.
	if ($nextSunday < $nextWednesday) {
		if (!$isFriday)
			$prefix = Carbon::now()->previous(Carbon::FRIDAY)->format('Y-m-d');
		else
			$prefix = date('Y-m-d');
		$deadline = strtotime(date($prefix . deadline()->deadline_sunday));
		if ($current <= $deadline) {
			$current = $nextSunday;
			for ($i = 1; $i <= 7; $i++) {
				$dates[] = [
					'day' => date('D', $current),
					'date' => date('d', $current),
					'month' => date('M', $i % 2 == 0 ? $current += $fourDays : $current += $threeDays),
					'actual' => date('Y-m-d', $current)
				];
			}
		} else {
			$current = $nextWednesday;
			for ($i = 1; $i <= 7; $i++) {
				$dates[] = [
					'day' => date('D', $current),
					'date' => date('d', $current),
					'month' => date('M', $i % 2 == 0 ? $current += $threeDays : $current += $fourDays),
					'actual' => date('Y-m-d', $current)
				];
			}
		}
	} else {
		if (!$isMonday)
			$prefix = Carbon::now()->previous(Carbon::MONDAY)->format('Y-m-d');
		else
			$prefix = date('Y-m-d');
		$deadline = strtotime(date($prefix . deadline()->deadline_wednesday));
		if ($current <= $deadline) {
			$current = $nextWednesday;
			for ($i = 1; $i <= 7; $i++) {
				$dates[] = [
					'day' => date('D', $current),
					'date' => date('d', $current),
					'month' => date('M', $i % 2 == 0 ? $current += $threeDays : $current += $fourDays),
					'actual' => date('Y-m-d', $current)
				];
			}
		} else {
			$current = $nextSunday;
			for ($i = 1; $i <= 7; $i++) {
				$dates[] = [
					'day' => date('D', $current),
					'date' => date('d', $current),
					'month' => date('M', $i % 2 == 0 ? $current += $fourDays : $current += $threeDays),
					'actual' => date('Y-m-d', $current)
				];
			}
		}
	}
	return $dates;
}