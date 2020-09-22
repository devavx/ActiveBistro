<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
	public function index ()
	{
		$listData = Faq::all();
		return view('backend/admin/faqs/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/faqs/create');
	}

	public function store (Request $request)
	{
		if (!empty(count($request['faq_title']))) {

			for ($i = 0; $i < count($request->faq_title); $i++) {
				$res = Faq::create([
					'faq_title' => $request['faq_title'][$i],
					'faq_description' => $request['faq_description'][$i],
				]);
			}
			if ($res) {
				return redirect('admin/faqs')->with('success', 'Faqs Added successfully!');
			} else {
				return redirect()->back('errormsg', 'OPPS!! Something Went Wrong!');
			}
		} else {
			return redirect()->back('errormsg', 'OPPS!! Something Went Wrong!');
		}

	}

	public function edit ($id)
	{
		$record = Faq::where('id', $id)->first();
		if (!empty($record)) {
			return view('backend/admin/faqs/edit', compact('record'));
		}
		return redirect('admin/faqs');
	}

	public function update (Request $request, $id)
	{
		$data = Faq::where('id', $id)->first();
		if (empty($data)) {
			return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
		}
		$data->faq_title = $request->faq_title;
		$data->faq_description = $request->faq_description;
		$save = $data->update();
		if ($save) {
			return redirect('admin/faqs')->with('success', 'Faq Updated successfully!');
		} else {
			return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Faq::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Faq Deleted Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'OPPS! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = Faq::find($id);
		if (!empty($data)) {
			if ($data->active) {
				$data->active = 0;
			} else {
				$data->active = 1;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Stactus Change Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'OPPS! Something Went Wrong!';
		}
		return json_encode($result);
	}
}
