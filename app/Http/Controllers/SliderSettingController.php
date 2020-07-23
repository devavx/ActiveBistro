<?php

namespace App\Http\Controllers;

use App\SliderSetting;
use Illuminate\Http\Request;

class SliderSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData =  SliderSetting::all();
        return view('backend/admin/slider-setting/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/slider-setting/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');

        $imageName = rand() . '.' . $image->extension();

        // $image->move(public_path('images'), $imageName);
        $request->file('file')->storeAs('public/sliders',$imageName);
        $res = SliderSetting::create([
                'thumbnail' =>$imageName,
            ]);
        return response()->json(['success' => $imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SliderSetting  $sliderSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SliderSetting $sliderSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SliderSetting  $sliderSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderSetting $sliderSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SliderSetting  $sliderSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderSetting $sliderSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SliderSetting  $sliderSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderSetting $sliderSetting)
    {
        //
    }

    function fetch()
    {
     $images = SliderSetting::all();
     $output = '<div class="row">';
     foreach($images as $image)
     {
      $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.$image->thumbnail.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->id.'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    public function delete($id='')
    {
        $result = array();
        $data =  SliderSetting::find($id);
        if (!empty($data)) {
            // unlink(url('/storage/app/public/sliders/'.$data->thumbnail));
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'Slider Image Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }
}
