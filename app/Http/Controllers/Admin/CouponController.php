<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CouponController extends Controller
{
	public function __construct ()
	{

	}

	public function index ()
	{
		return view('backend.admin.coupon.index');
	}
}