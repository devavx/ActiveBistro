<?php

namespace App\Http\Controllers;

use App\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData =  TermCondition::all();
        return view('backend/admin/term-conditions/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/term-conditions/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res=TermCondition::create($request->all());        
        if ($res){ 
            return redirect('admin/term_conditions')->with('success','TermCondition Added successfully!');;
        }else{ 
                return redirect()->back('errormsg','OPPS!! Something Went Wrong!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function show(TermCondition $termCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function edit(TermCondition $termCondition)
    {
        return view('backend/admin/term-conditions/edit',compact('termCondition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermCondition $termCondition)
    {
        $termCondition->description = $request->description;          
        $save = $termCondition->save();
        if ($save) {
            return redirect('admin/term_conditions')->with('success','TermCondition Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermCondition $termCondition)
    {
        //
    }

    public function delete($id='')
    {
        $result = array();
        $data =  TermCondition::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'TermCondition Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    } 
}
