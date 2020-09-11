<?php

namespace App\Http\Controllers\Admin;

use App\Allergy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = Allergy::all();
        return view('backend/admin/allergy/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/allergy/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Allergy::create($request->all());
        if ($res) {
            return redirect('admin/allergy')->with('success', 'Record Added successfully!');;
        } else {
            return redirect()->back('errormsg', 'OPPS!! Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function show(Allergy $allergy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function edit(Allergy $allergy)
    {
        $record = $allergy;
        if (!empty($record)) {
            return view('backend/admin/allergy/edit', compact('record'));
        }
        return redirect('admin/allergy')->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allergy $allergy)
    { 
        $allergy->name = $request->name;
        $allergy->description = $request->description;
        $save = $allergy->save();
        if ($save) {
            return redirect('admin/allergy')->with('success', 'Record Updated successfully!');
        } else {
            return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allergy  $allergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allergy $allergy)
    {
        //
    }

    public function delete($id = '')
    {
        $result = array();
        $data = Allergy::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status'] = 'success';
            $result['message'] = 'Record Deleted Sucessfully !';
        } else {
            $result['status'] = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }

    public function deleteBulk()
    {
        $result = array();
        $result['success'] = 1;
        $result['message'] = 'Record(s) deleted successfully!';
        $result['data'] = [];
        Allergy::whereIn('id', request('items', []))->delete();
        return response()->json($result);
    }

    public function changeStatus($id = '')
    {
        $result = array();
        $data = Allergy::find($id);
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

    public function getAllergyDetails()
    {
        $id = request('id'); 
        $result = array();
        $data = Allergy::find($id);
        
        return json_encode($data);
    }
}
