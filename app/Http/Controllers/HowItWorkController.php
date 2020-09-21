<?php

namespace App\Http\Controllers;

use App\HowItWork;
use App\Models\Coupon;
use Illuminate\Http\Request;

class HowItWorkController extends Controller
{
	public function index ()
	{
		$listData = HowItWork::all();
		return view('backend/admin/how-it-works/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/how-it-works/create');
	}

	public function store (Request $request)
	{
		$rules = [
			'title' => 'bail|required|image|max:1024',
			'description' => 'bail|required|string|max:10000'
		];
		$validated = $request->validate($rules);
		$res = HowItWork::query()->create($validated);
		if ($res) {
			return redirect('admin/how_it_works')->with('success', 'HowItWork Added successfully!');
		} else {
			return redirect()->back('errormsg', 'Oops! Something went wrong!');
		}
	}

	public function show (HowItWork $howItWork)
	{
		//
	}

	public function edit (HowItWork $howItWork)
	{
		return view('backend/admin/how-it-works/edit', compact('howItWork'));
	}

	public function update (Request $request, HowItWork $howItWork)
	{
		$rules = [
			'title' => 'bail|sometimes|image|max:1024',
			'description' => 'bail|required|string|max:10000'
		];
		$validated = $request->validate($rules);
		$save = $howItWork->update($validated);
		if ($save) {
			return redirect('admin/how_it_works')->with('success', 'HowItWork updated successfully!');
		} else {
			return back()->with('errormsg', 'Oops! Something went wrong! Try Again!');
		}
	}

	public function destroy (HowItWork $howItWork)
	{
		//
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = HowItWork::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'HowItWork deleted successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}

		return json_encode($result);
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'HowItWork(s) deleted successfully!';
		$result['data'] = [];
		HowItWork::query()->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = HowItWork::find($id);
		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Status changed successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}
		return json_encode($result);
	}
}