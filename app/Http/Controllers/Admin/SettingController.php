<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

	public function contactUs ()
	{
		$data = HomeSetting::where('type', 'contact_us')->select('other_option')->first();
		if ($data == null) {
			$data = HomeSetting::query()->create([
				'type' => 'contact_us'
			]);
		}
		$recordData = json_decode($data->other_option);
		return view('backend/admin/contact-us/create', compact('recordData'));
	}

	public function saveContactUs (Request $request)
	{
		$check = HomeSetting::where('type', 'contact_us')->first();
		if (!empty($check)) {
			$check->other_option = json_encode($request->all());
			$save = $check->update();
		} else {
			$save = HomeSetting::create([
				'type' => 'contact_us',
				'other_option' => json_encode($request->all())
			]);
		}
		if ($save) {
			return back()->with('success', 'Details updated successfully!');
		} else {
			return back()->with('errormsg', $this->commonError());
		}
	}


}
