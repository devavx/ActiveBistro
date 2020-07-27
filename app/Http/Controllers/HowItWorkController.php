<?php

namespace App\Http\Controllers;

use App\HowItWork;
use Illuminate\Http\Request;

class HowItWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = HowItWork::all();
        return view('backend/admin/how-it-works/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend/admin/how-it-works/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $res=HowItWork::create($request->all());        
        if ($res){ 
            return redirect('admin/how_it_works')->with('success','HowItWork Added successfully!');;
        }else{ 
                return redirect()->back('errormsg','OPPS!! Something Went Wrong!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function show(HowItWork $howItWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function edit(HowItWork $howItWork)
    {
        return view('backend/admin/how-it-works/edit',compact('howItWork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HowItWork $howItWork)
    {          
        $howItWork->description = $request->description;          
        $save = $howItWork->save();
        if ($save) {
            return redirect('admin/how_it_works')->with('success','HowItWork Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HowItWork  $howItWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(HowItWork $howItWork)
    {
        //
    }

    public function delete($id='')
    {
        $result = array();
        $data =  HowItWork::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'HowItWork Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    } 
    public function changeStatus($id=''){
        $result = array();
        $data =  HowItWork::find($id);
        if (!empty($data)) {
            if($data->active == '0') {
                $data->active=1;
            }else{
                $data->active = 0;
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
