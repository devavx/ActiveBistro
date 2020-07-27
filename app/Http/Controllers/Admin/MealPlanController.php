<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MealPlanRules;
use App\MealPlan;

class MealPlanController extends Controller
{
    public function index()
    {
    	$mealList = MealPlan::all();
    	return view('backend/admin/mealplan/index', compact('mealList'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/admin/mealplan/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealPlanRules $request)
    {      
         $res=MealPlan::create($request->all());
        if ($res) { 
            return redirect('admin/meals')->with('success','MealPlan Added successfully!');;
        }else{ 
            return redirect()->back('errormsg','Something Went Wrong!'); 
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(MealPlan $MealPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
    	$mealplan =MealPlan::where('id',$id)->first(); 
        if (!empty($mealplan)) {
        	return view('backend/admin/mealplan/edit',compact('mealplan')); 
        }
        return redirect('admin/meals');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(MealPlanRules $request,$id)
    { 
    	// echo "<pre>";
    	// print_r($mealplan);die;
    	$mealplan =MealPlan::where('id',$id)->first(); 
    	if (empty($mealplan)) {
    		return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
    	}
        $mealplan->name       = $request->name;
        $mealplan->no_of_days = $request->no_of_days;
        $mealplan->rate_per_item   = $request->rate_per_item;
        $mealplan->meal_in_two_days   = $request->meal_in_two_days;
        $mealplan->meal_in_three_days   = $request->meal_in_three_days; 
        $mealplan->rate_per_item_three_days = $request->rate_per_item_three_days; 
        $save = $mealplan->update();
        if ($save) {
            return redirect('admin/meals')->with('success','MealPlan Updated successfully!');
        }else{
            return back()->with('errormsg','Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
    public function delete($id='')
    {
        $result = array();
        $data =  MealPlan::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status']  = 'success';
            $result['message'] = 'MealPlan Deleted Sucessfully !';
        }else{
            $result['status']  = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }
    public function changeStatus($id=''){
        $result = array();
        $data =  MealPlan::find($id);
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
