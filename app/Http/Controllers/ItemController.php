<?php

namespace App\Http\Controllers;

use App\Item;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\AddEditItemRule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listData = Item::all();
        return view('backend/admin/item/index', compact('listData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listData = Ingredient::all();
        return view('backend/admin/item/create',compact('listData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddEditItemRule $request)
    {
        if($request->hasFile('thumbnail')){
            $thumbnail=$request->thumbnail;
            $image=$request->file('thumbnail');
            $newimg=rand().'_'.$image->getClientOriginalname();
            // $image->move(public_path('images'), $newimg); 
            // $fileNameWithExt = $request->file('thumbnail')->getClientOriginalImage();
            // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // $ext = $request->file('thumbnail')->getClientOriginalExtension();
            // $filenameToStore = $filename.'-'.rand().'.'.$ext;
            $storeImage = $request->file('thumbnail')->storeAs('public/items',$newimg);
        }else{
            $newimg = 'noimage.png';
        }
         
        $product= Item::create([
            'name'=>$request->name,
            'sub_name'=>$request->sub_name, 
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'protein'=>($request->protein) ? $request->protein:0,
            'calories'=>($request->calories) ? $request->calories:0,
            'thumbnail'=>$newimg,
            'carbs'=>($request->carbs) ? $request->carbs:0, 
            'item_type_id'=>($request->item_type_id) ? $request->item_type_id:0, 
            'category_id'=>($request->category_id) ? $request->category_id:0 
         ]);
        if($product) {
            $product->ingredients()->attach($request->ingredient_id);
            return  redirect('admin/items')->with('success','Item Added Successfully');
        }else{
            return back()->with('errormsg','Whoops!! Somthing Went Wrong! Try Again!!');
        }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $listData = Ingredient::all();  
        if (!empty($item)) {
            $record=$item;
            return view('backend/admin/item/edit',compact(['item','listData'])); 
        }
        return redirect('admin/items')->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        if($request->hasFile('thumbnail')){
            $thumbnail=$request->thumbnail;
            $image=$request->file('thumbnail');
            $newimg=rand().'_'.$image->getClientOriginalname(); 
            $storeImage = $request->file('thumbnail')->storeAs('public/items',$newimg);
            $item->thumbnail = $newimg;
        }          
         
        $item->name = $request->name;
        $item->sub_name = $request->sub_name; 
        $item->short_description = $request->short_description;
        $item->long_description = $request->long_description;
        $item->protein = ($request->protein) ? $request->protein:0;
        $item->calories = ($request->calories) ? $request->calories:0; 
        $item->carbs = ($request->carbs) ? $request->carbs:0; 
        $item->item_type_id = ($request->item_type_id) ? $request->item_type_id:0; 
        $item->category_id = ($request->category_id) ? $request->category_id:0; 
        $item->ingredients()->detach();
        if($item->save()) {
            $item->ingredients()->attach($request->ingredient_id);
            return  redirect('admin/items')->with('success','Item Updated Successfully');
        }else{
            return back()->with('errormsg','Whoops!! Somthing Went Wrong! Try Again!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function delete($id='')
    {
        $result = array();
        $data =  Item::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'Item Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }
}
