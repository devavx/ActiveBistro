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
				'deadline_sunday' => date('H:i:00'),
				'deadline_wednesday' => date('H:i:00')
			]);
		}
		return view('backend.admin.deadline.edit')->with('deadline', $deadline);
	}

	public function update ()
	{
		$deadline = DeliveryDeadline::query()->first();
		if ($deadline == null) {
			DeliveryDeadline::query()->create([
				'deadline_sunday' => $this->convert(request('deadline_sunday')),
				'deadline_wednesday' => $this->convert(request('deadline_wednesday')),
			]);
		} else {
			$deadline->update([
				'deadline_sunday' => $this->convert(request('deadline_sunday')),
				'deadline_wednesday' => $this->convert(request('deadline_wednesday')),
			]);
		}
		return redirect('admin/delivery_deadline')->with('success', 'Deadline updated successfully!');
	}

	protected function convert ($time): string
	{
		return date('H:i:00', strtotime($time));
	}
}
