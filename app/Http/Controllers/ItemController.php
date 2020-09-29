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
		dd($request->all());
		$product = Item::query()->create($request->validated());
		if ($product) {
			$product->ingredients()->attach($request->ingredient_id);
			return redirect('admin/items')->with('success', 'Item Added Successfully');
		} else {
			return back()->with('errormsg', 'Whoops!! Somthing Went Wrong! Try Again!!');
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
		return redirect('admin/items')->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
	}

	public function update (UpdateRequest $request, Item $item)
	{
		$item->name = $request->name;
		if ($request->hasFile('thumbnail')) {
			$item->thumbnail = $request->file('thumbnail');
		}
		$item->short_description = $request->short_description;
		$item->long_description = $request->long_description;
		$item->protein = ($request->protein) ? $request->protein : 0;
		$item->calories = ($request->calories) ? $request->calories : 0;
		$item->carbs = ($request->carbs) ? $request->carbs : 0;
		$item->fat = ($request->fat) ? $request->fat : 0;
		$item->selling_price = ($request->selling_price) ? $request->selling_price : 0;
		$item->actual_price = ($request->actual_price) ? $request->actual_price : 0;
		$item->item_type_id = ($request->item_type_id) ? $request->item_type_id : 0;
		$item->category_id = ($request->category_id) ? $request->category_id : 0;
		$item->ingredients()->detach();
		if ($item->save()) {
			$item->ingredients()->attach($request->ingredient_id);
			return redirect('admin/items')->with('success', 'Item Updated Successfully');
		} else {
			return back()->with('errormsg', 'Whoops!! Somthing Went Wrong! Try Again!!');
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
			$result['message'] = 'OPPS! Something Went Wrong!';
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
