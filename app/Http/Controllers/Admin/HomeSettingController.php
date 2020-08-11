<?php

namespace App\Http\Controllers\Admin;

use App\HomeSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = HomeSetting::all();
        return view('backend/admin/home-setting/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/home-setting/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $res=HomeSetting::create($request->all()); 
        if($request->hasFile('thumbnail')){
            $thumbnail=$request->thumbnail;
            $image=$request->file('thumbnail');
            $newimg=rand().'_'.time().'_'.$image->getClientOriginalname(); 
            $storeImage = $request->file('thumbnail')->storeAs('public/home-setting',$newimg);
        }else{
            $newimg = '';
        } 
        // echo "<pre>";
        // print_r($request->all());die;
        $res= HomeSetting::create([
            'title'=>$request->title, 
            'description'=>$request->description,
            'type'=>'home_content',  
            'thumbnail'=>$newimg
         ]);       
        if ($res){ 
            return redirect('admin/home_setting')->with('success','Record Added successfully!');;
        }else{ 
            return redirect()->back('errormsg','OPPS!! Something Went Wrong!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSetting $homeSetting)
    {  
        if (!empty($homeSetting)) {
            return view('backend/admin/home-setting/edit',compact('homeSetting')); 
        }
        return redirect('admin/home_setting');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSetting $homeSetting)
    {
         if (!empty($homeSetting)) {
            return view('backend/admin/home-setting/edit',compact('homeSetting')); 
        }
        return redirect('admin/home_setting');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSetting $homeSetting)
    {
        if($request->hasFile('thumbnail')){
            $thumbnail=$request->thumbnail;
            $image=$request->file('thumbnail');
            $newimg=rand().'_'.time().'_'.$image->getClientOriginalname(); 
            $storeImage = $request->file('thumbnail')->storeAs('public/home-setting',$newimg);
            $homeSetting->thumbnail = $newimg;
        } 
        $homeSetting->title       = $request->title;
        $homeSetting->description = $request->description; 
        $save = $homeSetting->save(); 
        if ($save) { 
            return redirect('admin/home_setting')->with('success','Record Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSetting $homeSetting)
    {
        //
    }

     public function delete($id='')
    {
        $result = array();
        $data =  HomeSetting::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'Record Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }
    public function changeStatus($id=''){
        $result = array();
        $data =  HomeSetting::find($id);
        if (!empty($data)) {
            if($data->active) {
                $data->active = 0; 
            }else{
                $data->active=1;
            } 
            $data->update();
            $result['status']  = 'success';
            $result['message'] = 'Stactus Change Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }
        return json_encode($result);
    }
}
