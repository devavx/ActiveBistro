<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Items\StoreRequest;
use App\Http\Requests\Items\UpdateRequest;
use App\Ingredient;
use App\Item;
use App\ItemType;
use App\MealPlan;

class ItemController extends Controller
{
	public function index ()
	{
		$listData = Item::query()->latest()->get();
		return view('backend.admin.item.index', compact('listData'));
	}

	public function create ()
	{
		$listData = Ingredient::all();
		$categoryList = Category::all();
		$itemTypeList = ItemType::all();
		return view('backend/admin/item/create', compact(['listData', 'categoryList', 'itemTypeList']));
	}

	public function store (StoreRequest $request)
	{
		$validated = $request->validated();
		$product = Item::query()->create($validated);
		if ($product) {
			$product->ingredients()->attach($validated['ingredient_id'] ?? []);
			return redirect('admin/items')->with('success', $this->storeOkay());
		} else {
			return back()->with('errormsg', $this->commonError());
		}
	}

	public function show ($id)
	{
		/**
		 * @var MealPlan $item
		 */
		$item = Item::query()->whereKey($id)->first();
		if ($item != null) {
			return response()->json(['success' => 1, 'message' => '', 'data' => view('backend.admin.item.show')->with('item', $item)->render()]);
		} else {
			return response()->json(['success' => 0, 'message' => '', 'data' => null]);
		}
	}

	public function edit (Item $item)
	{
		$listData = Ingredient::all();
		$categoryList = Category::all();
		$itemTypeList = ItemType::all();
		if (!empty($item)) {
			$record = $item;
			return view('backend/admin/item/edit', compact(['item', 'listData', 'categoryList', 'itemTypeList']));
		}
		return redirect('admin/items')->with('errormsg', $this->commonError());
	}

	public function update (UpdateRequest $request, Item $item)
	{
		$validated = $request->validated();
		$item->update($validated);
		$item->ingredients()->detach();
		if ($item->save()) {
			$item->ingredients()->attach($validated['ingredient_id'] ?? []);
			return redirect('admin/items')->with('success', 'Item Updated Successfully');
		} else {
			return back()->with('errormsg', $this->commonError());
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Item::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Item Deleted Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = $this->commonError();
		}

		return json_encode($result);
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Item(s) deleted successfully!';
		$result['data'] = [];
		Item::query()->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = Item::find($id);

		if (!empty($data)) {
			if ($data->active == '0') {
				$data->active = 1;
			} else {
				$data->active = 0;
			}
			$data->update();
			$result['status'] = 'success';
			$result['message'] = 'Item Status Change Successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function orders ()
	{
		$listData = [];
		return view('backend/admin/orders/index', compact('listData'));
	}
}
