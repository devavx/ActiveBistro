<?php

namespace App\Http\Controllers;

use App\Core\Traits\BulkDelete;
use App\Models\SliderSetting;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SliderSettingController extends Controller
{
	use BulkDelete;

	public function __construct ()
	{
		$this->setBoundModel(SliderSetting::class);
	}

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
			$data->delete();
			$result['status'] = 'success';
			$result['message'] = 'SliderImage deleted successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = $this->commonError();
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
			$result['message'] = 'Status changed successfully !';
		} else {
			$result['status'] = 'error';
			$result['message'] = $this->commonError();
		}
		return json_encode($result);
	}
}
