<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealPlanRules;
use App\Item;
use App\MealPlan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class DailyMealPlanController extends Controller
{
    public function index(): Renderable
    {
        $plans = MealPlan::all();
        return view('backend.admin.dailymealplan.index')->with('plans', $plans);
    }

    public function create(): Renderable
    {
        $listData = Item::query()->where('active', 1)->get();
        return view('backend.admin.dailymealplan.create', compact('listData'));
    }

    public function store(MealPlanRules $request)
    {
        $plan = MealPlan::query()->create($request->validated());
        Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
            $plan->images()->create(['file' => $file]);
        });
        Collection::make(\request('item_id', []))->each(function ($itemId) use ($plan) {
            $plan->mealItems()->create(['item_id' => $itemId]);
        });
        if ($plan != null) {
            return redirect()->route('admin.daily-meals.index')->with('success', 'MealPlan Added successfully!');
        } else {
            return redirect()->back('errormsg', 'Something Went Wrong!');
        }
    }

    public function edit($id)
    {
        $mealplan = MealPlan::query()->where('id', $id)->first();
        $listData = Item::query()->where('active', 1)->get();
        $bound = $mealplan->mealItems->pluck('id')->toArray();
        if (!empty($mealplan)) {
            return view('backend.admin.dailymealplan.edit', compact(['mealplan', 'listData']))->with('bound', $bound);
        }
        return redirect()->route('admin.daily-meals.index');

    }

    public function update(MealPlanRules $request, $id)
    {
        $mealplan = MealPlan::where('id', $id)
            ->first();
        if (empty($mealplan)) {
            return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
        }
        if ($request->hasFile('rate_per_item_three_days')) {
            $rate_per_item_three_days = $request->rate_per_item_three_days;
            $image = $request->file('rate_per_item_three_days');
            $newimg = rand() . '_' . time() . '_' . $image->getClientOriginalname();
            $storeImage = $request->file('rate_per_item_three_days')->storeAs('public/items', $newimg);
            $mealplan->rate_per_item_three_days = $newimg;
        }


        $mealplan->name = $request->name;
        $mealplan->no_of_days = $request->no_of_days;
        $mealplan->rate_per_item = $request->rate_per_item;
        // $mealplan->meal_in_two_days   = $request->meal_in_two_days;
        // $mealplan->meal_in_three_days   = $request->meal_in_three_days; 
        // $mealplan->rate_per_item_three_days= $request->rate_per_item_three_days; 

        $save = $mealplan->update();
        $mealplan->items()->detach();
        if ($save) {
            $mealplan->items()->attach($request->item_id);
            return redirect('admin/daily-meals')->with('success', 'MealPlan Updated successfully!');
        } else {
            return back()->with('errormsg', 'Whoops!! Somthig Went wrong! Try Again!');
        }
    }

    public function destroy(City $city)
    {
        //
    }

    public function delete($id = '')
    {
        $result = array();
        $data = MealPlan::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status'] = 'success';
            $result['message'] = 'MealPlan Deleted Sucessfully !';
        } else {
            $result['status'] = 'error';
            $result['message'] = 'OPPS! Something Went Wrong!';
        }

        return json_encode($result);
    }

    public function changeStatus($id = '')
    {
        $result = array();
        $data = MealPlan::find($id);
        if (!empty($data)) {
            if ($data->active) {
                $data->active = 0;
            } else {
                $data->active = 1;
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
}
