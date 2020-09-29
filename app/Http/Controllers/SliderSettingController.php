<?php

namespace App\Http\Controllers;

use App\SliderSetting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SliderSettingController extends Controller
{
	public function index ()
	{
		$listData = SliderSetting::all();
		return view('backend/admin/slider-setting/index', compact('listData'));
	}

	public function create ()
	{
		return view('backend/admin/slider-setting/create');
	}

	public function store (Request $request)
	{
		collect($request->file('file', []))->each(function (UploadedFile $file) {
			SliderSetting::query()->create([
				'thumbnail' => $file,
				'thumbnail_type' => $file->getMimeType()
			]);
		});
		return response()->json(['success' => 1]);
	}

	public function show (SliderSetting $sliderSetting)
	{
		//
	}

	public function edit (SliderSetting $sliderSetting)
	{
		//
	}

	public function update (Request $request, SliderSetting $sliderSetting)
	{
		//
	}

	public function destroy (SliderSetting $sliderSetting)
	{
		//
	}

	function fetch ()
	{
		$images = SliderSetting::all();
		$output = '<div class="row">';
		foreach ($images as $image) {
			$output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="' . $image->thumbnail . '" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="' . $image->id . '">Remove</button>
            </div>
      ';
		}
		$output .= '</div>';
		echo $output;
	}

	public function delete ($id = '')
	{
		$result = array();
		$data = SliderSetting::find($id);
		if (!empty($data)) {
			// unlink(url('/storage/app/public/sliders/'.$data->thumbnail));
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'Slider Image Deleted Sucessfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'OPPS! Something Went Wrong!';
		}

		return json_encode($result);
	}

	public function changeStatus ($id = '')
	{
		$result = array();
		$data = SliderSetting::find($id);
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
