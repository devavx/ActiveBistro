<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = PostalCode::all();
        return view('backend/admin/postal-codes/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/postal-codes/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty(count($request['name']))) {            
            for ($i=0; $i < count($request->name); $i++) { 
                $res=PostalCode::create([
                    'name' => $request['name'][$i],
                    'description' => $request['description'][$i],
                ]);
            }
            if ($res){ 
                return redirect('admin/postal_codes')->with('success','PostalCode Added successfully!');;
            }else{ 
                return redirect()->back('errormsg','OPPS!! Something Went Wrong!'); 
            }
        }else{ 
            return redirect()->back('errormsg','OPPS!! Something Went Wrong!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record =PostalCode::where('id',$id)->first(); 
        if (!empty($record)) {
            return view('backend/admin/postal-codes/edit',compact('record')); 
        }
        return redirect('admin/postal_codes');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =PostalCode::where('id',$id)->first(); 
        if (empty($data)) {
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
        $data->name       = $request->name;          
        $data->description = $request->description;          
        $save = $data->update();
        if ($save) {
            return redirect('admin/postal_codes')->with('success','Faq Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id='')
    {
        $result = array();
        $data =  PostalCode::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'PostalCode Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    } 
    public function changeStatus($id=''){
        $result = array();
        $data =  PostalCode::find($id);
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
