<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

class FaqCategoryController extends Controller
{
	public function __construct ()
	{

	}

	public function index ()
	{
		$categories = FaqCategory::query()->latest()->get();
		return view('backend.admin.faq-categories.index')->with('categories', $categories);
	}
}