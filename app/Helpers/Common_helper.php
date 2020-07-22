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
