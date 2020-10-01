<?php

namespace App\Http\Controllers\Admin;

use App\Core\Traits\BulkDelete;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
	use BulkDelete;

	public function __construct ()
	{
		$this->setBoundModel(Faq::class);
	}

	public function index ()
	{
		$listData = Faq::all();
		return view('backend/admin/faqs/index', compact('listData'));
	}

	public function create ()
	{
		$categories = FaqCategory::query()->where('active', true)->get();
		return view('backend/admin/faqs/create')->with('categories', $categories);
	}

	public function store (Request $request)
	{
		if (!empty(count($request['faq_title']))) {

			for ($i = 0; $i < count($request->faq_title); $i++) {
				$res = Faq::create([
					'faq_category_id' => $request->faq_category_id,
					'faq_title' => $request['faq_title'][$i],
					'faq_description' => $request['faq_description'][$i],
				]);
			}
			if ($res) {
				return redirect('admin/faqs')->with('success', 'Faqs Added successfully!');
			} else {
				return redirect()->back('errormsg', 'Oops!! Something Went Wrong!');
			}
		} else {
			return redirect()->back('errormsg', 'Oops!! Something Went Wrong!');
		}

	}

	public function edit ($id)
	{
		$categories = FaqCategory::query()->where('active', true)->get();
		$record = Faq::where('id', $id)->first();
		if (!empty($record)) {
			return view('backend/admin/faqs/edit', compact('record'))->with('categories', $categories);
		}
		return redirect('admin/faqs');
	}

	public function update (Request $request, $id)
	{
		$data = Faq::where('id', $id)->first();
		if (empty($data)) {
			return back()->with('errormsg', 'Oops! Something went wrong! Try Again!');
		}
		$data->faq_title = $request->faq_title;
		$data->faq_description = $request->faq_description;
		$data->faq_category_id = $request->category_id;
		$save = $data->update();
		if ($save) {
			return redirect('admin/faqs')->with('success', 'Faq Updated successfully!');
		} else {
			return back()->with('errormsg', 'Oops!! Something went wrong! Try Again!');
		}
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = Faq::find($id);
		if (!empty($data)) {
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Faq deleted successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
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
			$result['message'] = 'Status changed successfully!';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Oops! Something went wrong!';
		}
		return json_encode($result);
	}
}
