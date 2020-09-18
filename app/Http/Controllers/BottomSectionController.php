<?php

namespace App\Http\Controllers;

use App\BottomSection;
use App\Core\Primitives\Str;

class BottomSectionController extends Controller
{
	public function index ()
	{
		$section = BottomSection::query()->first();
		if ($section == null) {
			$section = BottomSection::query()->create([
				'link' => Str::Empty,
				'link_text' => Str::Empty,
				'image' => null,
				'content' => Str::Empty
			]);
		}
		return view('backend/admin/bottom_section/edit')->with('section', $section);
	}

	public function store ()
	{
		$section = BottomSection::query()->first();
		if ($section == null) {
			BottomSection::query()->create([
				'link' => request('link'),
				'link_text' => request('link_text'),
				'image' => request()->file('image'),
				'content' => request('content')
			]);
		} else {
			$section->update([
				'link' => request('link'),
				'link_text' => request('link_text'),
				'image' => request()->file('image'),
				'content' => request('content')
			]);
		}
		return redirect('admin/bottom_section')->with('success', 'Bottom section updated successfully!');
	}
}
