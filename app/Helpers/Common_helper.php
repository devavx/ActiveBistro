<?php

function changeDateFormat($date, $format){
	try {
		return \Carbon\Carbon::parse($date)->format($format);
	} catch (Exception $e) {
		return false;
	}
  
  // DateTime::createFromFormat($from, $date)->format($to);  
}

function changeTimeFormat($time, $format){
	try {
		return \Carbon\Carbon::parse($time)->format($format); 
	} catch (Exception $e) {
		return false;
	}
    
}

function timeFormat24To12($time='')
{
	try {
		return date("g:i a", strtotime($time));;
	} catch (Exception $e) {
		return false;
	}
}


function getAllItemList()
{ 
	try {
		$catList = App\Item::all();  
	} catch (Exception $e) {
		$catList = [];
	} 
   	return $catList;
  
}
function getAllUserList()
{ 
   try {
		$userList = App\User::all();  
	} catch (Exception $e) {
		$userList = [];
	} 
   	return $userList;
}

function getAge($date1='',$date2='')
{
	// $date1 = "2007-03-24";
	// $date2 = "2009-06-26";
	try {
		$diff = abs(strtotime($date2) - strtotime($date1));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	} catch (Exception $e) {
		$years =1;
	}
	
	return $years;
	// printf("%d years, %d months, %d days\n", $years, $months, $days);
}

function getCalories($gender='',$weightInKG='',$heighIntCM='',$age=''){
	if ($gender=='male') {
		
		try {
			$calo = (99.99 * $weightInKG) + (6.25 * $heighIntCM) - (4.92 * $age + 5);
		} catch (Exception $e) {
			$calo=$e;
		}
	}else{
		try {
			$calo = (99.99 * $weightInKG) + (6.25 * $heighIntCM) - (4.92 * $age - 161);
		} catch (Exception $e) {
			$calo=$e;
		}
	}
	return $calo;
}