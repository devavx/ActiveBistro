<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
	public function __construct ()
	{

	}

	public function index ()
	{
		$categories = FaqCategory::query()->latest()->get();
		return view('backend.admin.faq-categories.index')->with('categories', $categories);
	}

	public function create (): Renderable
	{
		return view('backend.admin.faq-categories.create');
	}

	public function edit ($id)
	{
		$category = FaqCategory::query()->whereKey($id)->first();
		if ($category != null)
			return view('backend.admin.faq-categories.edit')->with('category', $category);
		else
			return redirect()->route('admin.faq-categories.index')->with('errormsg', 'Could not find FAQ category.');
	}

	public function store (Request $request)
	{
		$validated = $request->validate([
			'title' => 'bail|required|string|min:1|max:255'
		]);
		FaqCategory::query()->create($validated);
		return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ Category created successfully!');
	}

	public function update (Request $request, $id)
	{
		$validated = $request->validate([
			'title' => 'bail|required|string|min:1|max:255'
		]);
		$category = FaqCategory::query()->whereKey($id)->first();
		if ($category != null) {
			$category->update($validated);
			return redirect()->route('admin.faq-categories.index')->with('success', 'FAQ Category updated successfully!');
		} else {
			return redirect()->route('admin.faq-categories.index')->with('errormsg', 'Could not find FAQ category.');
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = FaqCategory::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Record deleted successfully !';
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
		$result['message'] = 'Record(s) deleted successfully!';
		$result['data'] = [];
		FaqCategory::whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = FaqCategory::find($id);
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