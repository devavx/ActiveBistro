<?php

namespace App\Http\Controllers;

use App\Core\Enums\Common\UnitSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
	public function updateUserDetail (Request $request)
	{
		$userData = Auth::user();
		if ($request->hasFile('profile_image')) {
			$userData->profile_image = $request->file('profile_image');
		}
		$userData->first_name = $request->first_name;
		$userData->last_name = $request->last_name;
		$userData->name = $request->first_name . ' ' . $request->last_name;
		$userData->address = $request->address;
		$userData->about = $request->about;
		$userData->dob = $request->dob;
		$userData->phone = $request->phone;
		if ($request->unit_system == UnitSystem::Metric) {
			$userData->weight_total = UnitSystem::Metric;
			$userData->unit_system = UnitSystem::Metric;
		} else {
			$userData->weight_total = UnitSystem::Imperial;
			$userData->unit_system = UnitSystem::Imperial;
		}
		if ($request->unit_system == UnitSystem::Metric) {
			$userData->user_height = $request->user_height;
			$userData->user_weight = $request->user_weight;
			$userData->user_targert_weight = $request->user_targert_weight;
		} else {
			$userData->user_height = $this->imperialToMetricLength($request->user_height);
			$userData->user_weight = $this->imperialToMetricWeight($request->user_weight);
			$userData->user_targert_weight = $this->imperialToMetricWeight($request->user_targert_weight);
		}
		$userData->diet_type = $request->diet_type;
		$userData->activity_lavel = $request->activity_lavel;
		$userData->weekly_progress = $request->weekly_progress;
		$userData->save();
		return back()->with('success', 'Details updated successfully!');
	}

	public function updatePassword (Request $request)
	{
		$input = $request->all();
		$result = array();
		$rules = [
			'current_password' => 'required',
			'new_password' => 'required|min:8',
			'confirm_password' => 'required|same:new_password',
		];
		$validator = Validator::make($input, $rules);
		if ($validator->fails()) {
			$result['status'] = 'error';
			$result['message'] = $validator->errors()->first();
		} else {
			$user = Auth::user();
			if ((Hash::check(request('current_password'), $user->password)) == false) {
				$result['status'] = 'error';
				$result['message'] = 'Check your current password';
			} else if ((Hash::check(request('new_password'), $user->password)) == true) {
				$result['status'] = 'error';
				$result['message'] = 'Please enter a password which is not similar then current password';
			} else {
				$user->update(['password' => Hash::make($input['new_password'])]);
				$result['status'] = 'success';
				$result['message'] = 'Password updated successfully';
			}
		}
		return json_encode($result);
	}

	public function getAllOrder ()
	{
		return view('frontend.my_order');
	}

	protected function imperialToMetricLength ($value)
	{
		return round($value * 30.48, 0);
	}

	protected function imperialToMetricWeight ($value)
	{
		return round($value / 2.20462, 2);
	}
}
