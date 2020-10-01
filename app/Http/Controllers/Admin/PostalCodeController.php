<?php

namespace App\Http\Controllers\Admin;

use App\Core\Traits\BulkDelete;
use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
	use BulkDelete;

	public function __construct ()
	{
		$this->setBoundModel(PostalCode::class);
	}

	public function index ()
	{
		$listData = PostalCode::all();
		return view('backend/admin/postal-codes/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/postal-codes/create');
	}

	public function store (Request $request)
	{
		if (!empty(count($request['name']))) {
			for ($i = 0; $i < count($request->name); $i++) {
				$res = PostalCode::create([
					'name' => $request['name'][$i],
					'description' => $request['description'][$i],
				]);
			}
			if ($res) {
				return redirect('admin/postal_codes')->with('success', 'PostalCode Added successfully!');
			} else {
				return redirect()->back('errormsg', 'Oops!! Something Went Wrong!');
			}
		} else {
			return redirect()->back('errormsg', 'Oops!! Something Went Wrong!');
		}
	}

	public function show ($id)
	{
		//
	}

	public function edit ($id)
	{
		$record = PostalCode::where('id', $id)->first();
		if (!empty($record)) {
			return view('backend/admin/postal-codes/edit', compact('record'));
		}
		return redirect('admin/postal_codes');
	}

	public function update (Request $request, $id)
	{
		$data = PostalCode::where('id', $id)->first();
		if (empty($data)) {
			return back()->with('errormsg', 'Whoops!! Something Went wrong! Try Again!');
		}
		$data->name = $request->name;
		$data->description = $request->description;
		$save = $data->update();
		if ($save) {
			return redirect('admin/postal_codes')->with('success', 'Faq Updated successfully!');
		} else {
			return back()->with('errormsg', 'Whoops!! Something Went wrong! Try Again!');
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = PostalCode::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'PostalCode Deleted successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = PostalCode::find($id);
		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Status Change successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something Went Wrong!';
		}
		return json_encode($result);
	}
}
