<?php

namespace App\Http\Controllers;

use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = ItemType::all();
        return view('backend/admin/item-type/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/item-type/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res=ItemType::create($request->all());
        if ($res){
            return redirect('admin/item_type')->with('success','ItemType Added successfully!');;
        }else{
            return redirect()->back('errormsg','OPPS!! Something Went Wrong!');
        }
    }

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\ItemType $itemType
	 * @return \Illuminate\Http\Response
	 */
    public function show(ItemType $itemType)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\ItemType $itemType
	 * @return \Illuminate\Http\Response
	 */
    public function edit(ItemType $itemType)
    {
        return view('backend/admin/item-type/edit',compact('itemType'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Models\ItemType $itemType
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, ItemType $itemType)
    {
        $itemType->name = $request->name;
        $save = $itemType->save();
        if ($save) {
            return redirect('admin/item_type')->with('success','ItemType Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Models\ItemType $itemType
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(ItemType $itemType)
    {
        //
    }

    public function delete($id='')
    {
        $result = array();
        $data =  ItemType::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status'] = 'success';
            $result['message'] = 'ItemType Deleted Sucessfully !';
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
        $result['message'] = 'Item(s) deleted successfully!';
        $result['data'] = [];
        ItemType::query()->whereIn('id', request('items', []))->delete();
        return response()->json($result);
    }

    public function changeStatus($id = '')
    {
        $result = array();
        $data = ItemType::find($id);
        if (!empty($data)) {
            if ($data->active == '0') {
                $data->active = 1;
            } else {
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
