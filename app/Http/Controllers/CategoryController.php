<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index ()
	{
		$listData = Category::query()->latest()->get();
		return view('backend/admin/category/index', compact('listData'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create ()
	{
		return view('backend/admin/category/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store (Request $request)
	{
		$res = Category::create($request->all());
		if ($res) {
			return redirect('admin/category')->with('success', 'Category Added successfully!');;
		} else {
			return redirect()->back('errormsg', 'OPPS!! Something Went Wrong!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function show (Category $category)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit (Category $category)
	{
		return view('backend/admin/category/edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function update (Request $request, Category $category)
	{
		$category->name = $request->name;
		$save = $category->save();
		if ($save) {
			return redirect('admin/category')->with('success', 'Category Updated successfully!');
		} else {
			return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\Category $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy (Category $category)
	{
		//
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Category::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Category Deleted Sucessfully !';
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
		$result['message'] = 'Categories Deleted Successfully!';
		$result['data'] = [];
		Category::query()->whereIn('id', \request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = Category::find($id);
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
