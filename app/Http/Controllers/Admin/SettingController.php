<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   
    public function contactUs()
    {
        return view('backend/admin/contact-us/create');
    }

    
}