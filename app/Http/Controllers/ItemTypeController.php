<?php

namespace App\Http\Controllers;

use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
	public function index ()
	{
		$listData = ItemType::all();
		return view('backend/admin/item-type/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/item-type/create');
	}

	public function store (Request $request)
	{
		$res = ItemType::create($request->all());
		if ($res) {
			return redirect('admin/item_type')->with('success', 'ItemType added successfully!');
		} else {
			return redirect()->back('errormsg', $this->commonError());
		}
	}

	public function show (ItemType $itemType)
	{
		//
	}

	public function edit (ItemType $itemType)
	{
		return view('backend/admin/item-type/edit', compact('itemType'));
	}

	public function update (Request $request, ItemType $itemType)
	{
		$itemType->name = $request->name;
		$save = $itemType->save();
		if ($save) {
			return redirect('admin/item_type')->with('success', 'ItemType updated successfully!');
		} else {
			return back()->with('errormsg', $this->commonError());
		}
	}

	public function destroy (ItemType $itemType)
	{
		//
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = ItemType::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'ItemType Deleted Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Item(s) deleted successfully!';
		$result['data'] = [];
		ItemType::query()->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = ItemType::find($id);
		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Status Change Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something Went Wrong!';
		}
		return json_encode($result);
	}
}
