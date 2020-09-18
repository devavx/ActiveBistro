<?php

namespace App\Http\Controllers;

use App\Core\Primitives\Str;
use App\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
	public function index ()
	{
		$policy = PrivacyPolicy::query()->first();
		if ($policy == null) {
			$policy = PrivacyPolicy::query()->create([
				'description' => Str::Empty
			]);
		}
		return view('backend.admin.privacy-policy.edit')->with('policy', $policy);
	}

	public function update ()
	{
		$policy = PrivacyPolicy::query()->first();
		if ($policy == null) {
			PrivacyPolicy::query()->create([
				'description' => request('description')
			]);
		} else {
			$policy->update([
				'description' => request('description')
			]);
		}
		return redirect('admin/privacy_policy')->with('success', 'Privacy policy updated successfully!');
	}
}
