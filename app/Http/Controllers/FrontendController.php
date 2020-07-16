<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
    	 return view('frontend.index');
    }

    public function login()
    {
    	 return view('frontend.login');
    }

    public function signup()
    {
    	 return view('frontend.signup');
    }

    public function ourmenu()
    {
    	 return view('frontend.ourmenu');
    }
}
