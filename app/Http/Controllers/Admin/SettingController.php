<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getPostalCodes()
    {
    	return view('backend/admin/postal-codes/index');
    }

    public function createPostalCodes()
    {
    	return view('backend/admin/postal-codes/create');
    }

    public function getHowItWorks()
    {
    	// return view('backend/admin/how-it-works/index');
    	return view('backend/admin/how-it-works/create');
    }

    public function createHowItWorks()
    {
    	return view('backend/admin/how-it-works/create');
    }

    public function termCondition()
    {
    	return view('backend/admin/term-conditions/create');
    }

    public function privacyPolicy()
    {
    	return view('backend/admin/privacy-policy/create');
    }

    public function contactUs()
    {
    	return view('backend/admin/contact-us/create');
    }
}
