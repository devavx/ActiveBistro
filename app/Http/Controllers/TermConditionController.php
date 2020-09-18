<?php

namespace App\Http\Controllers;

use App\Core\Primitives\Str;
use App\TermCondition;

class TermConditionController extends Controller
{
	public function index ()
	{
		$termCondition = TermCondition::query()->first();
		if ($termCondition == null) {
			$termCondition = TermCondition::query()->create([
				'description' => Str::Empty
			]);
		}
		return view('backend/admin/term-conditions/edit')->with('tnc', $termCondition);
	}

	public function update ()
	{
		$termCondition = TermCondition::query()->first();
		if ($termCondition == null) {
			TermCondition::query()->create([
				'description' => request('description')
			]);
		} else {
			$termCondition->update([
				'description' => request('description')
			]);
		}
		return redirect('admin/term_conditions')->with('success', 'Terms & conditions updated successfully!');
	}
}
