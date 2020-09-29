<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngredientRule;
use App\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
	public function index ()
	{
		$listData = Ingredient::query()->latest()->get();
		return view('backend/admin/ingredient/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/ingredient/create');
	}

	public function store (IngredientRule $request)
	{
		$res = Ingredient::create($request->all());
		if ($res) {
			return redirect('admin/ingredient')->with('success', 'Ingredient Added successfully!');
		} else {
			return redirect()->back('errormsg', $this->commonError());
		}
	}

	public function show ($id)
	{
		//
	}

	public function edit ($id)
	{
		$record = Ingredient::where('id', $id)->first();
		if (!empty($record)) {
			return view('backend/admin/ingredient/edit', compact('record'));
		}
		return redirect('admin/ingredient')->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
	}

	public function update (Request $request, $id)
	{
		$data = Ingredient::where('id', $id)->first();
		if (empty($data)) {
			return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
		}
		$data->name = $request->name;
		$save = $data->update();
		if ($save) {
			return redirect('admin/ingredient')->with('success', 'Ingredient Updated successfully!');
		} else {
			return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Ingredient::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Ingredient Deleted Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'OPPS! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Ingredient(s) deleted successfully!';
		$result['data'] = [];
		Ingredient::query()->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = Ingredient::find($id);
		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
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
