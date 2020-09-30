<?php

namespace App\Http\Controllers;

use App\Models\DeliveryDeadline;

class DeliveryDeadlineController extends Controller
{
	public function index ()
	{
		$deadline = DeliveryDeadline::query()->first();
		if ($deadline == null) {
			$deadline = DeliveryDeadline::query()->create([
				'deadline' => date('Y-m-d H:i:s', time() + 86400)
			]);
		}
		return view('backend.admin.deadline.edit')->with('deadline', $deadline);
	}

	public function update ()
	{
		$deadline = DeliveryDeadline::query()->first();
		if ($deadline == null) {
			DeliveryDeadline::query()->create([
				'deadline' => $this->convert(request('deadline'))
			]);
		} else {
			$deadline->update([
				'deadline' => $this->convert(request('deadline'))
			]);
		}
		return redirect('admin/delivery_deadline')->with('success', 'Deadline updated successfully!');
	}

	protected function convert ($dateTime): string
	{
		return date('Y-m-d H:i:s', strtotime($dateTime));
	}
}
