<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddEditItemRule;
use App\Ingredient;
use App\Item;
use App\ItemType;
use App\MealPlan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ItemController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|Response|View
	 */
	public function index ()
	{
		$listData = Item::query()->latest()->get();
		return view('backend.admin.item.index', compact('listData'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Application|Factory|Response|View
	 */
	public function create ()
	{
		$listData = Ingredient::all();
		$categoryList = Category::all();
		$itemTypeList = ItemType::all();
		return view('backend/admin/item/create', compact(['listData', 'categoryList', 'itemTypeList']));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param AddEditItemRule $request
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function store (AddEditItemRule $request)
	{
		$product = Item::query()->create([
			'name' => $request->name,
			'short_description' => $request->short_description,
			'long_description' => $request->long_description,
			'protein' => ($request->protein) ? $request->protein : 0,
			'calories' => ($request->calories) ? $request->calories : 0,
			'thumbnail' => $request->thumbnail,
			'carbs' => ($request->carbs) ? $request->carbs : 0,
			'fat' => ($request->fat) ? $request->fat : 0,
			'item_type_id' => ($request->item_type_id) ? $request->item_type_id : 0,
			'category_id' => ($request->category_id) ? $request->category_id : 0
		]);
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Item $item
	 * @return Application|Factory|Response|View
	 */
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

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Item $item
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function update (Request $request, Item $item)
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Item $item
	 * @return Response
	 */
	public function destroy (Item $item)
	{
		//
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|Response|View
	 */
	public function orders ()
	{
		$listData = [];
		return view('backend/admin/orders/index', compact('listData'));
	}
}
