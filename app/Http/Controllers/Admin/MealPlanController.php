<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealPlans\Fixed\StoreRequest;
use App\Http\Requests\MealPlans\Fixed\UpdateRequest;
use App\Item;
use App\MealPlan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class MealPlanController extends Controller
{
    public function index(): Renderable
    {
        $plans = MealPlan::query()->whereNull('day')->get();
        return view('backend.admin.mealplan.index')->with('plans', $plans);
    }

    public function create(): Renderable
    {
        $listData = Item::query()->where('active', 1)->get();
        return view('backend.admin.mealplan.create', compact('listData'));
    }

    public function store(StoreRequest $request)
    {
        $plan = MealPlan::query()->create($request->validated());
        Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
            $plan->images()->create(['file' => $file]);
        });
        Collection::make(\request('item_id', []))->each(function ($itemId) use ($plan) {
            $plan->mealItems()->create(['item_id' => $itemId]);
        });
        if ($plan != null) {
            return redirect()->route('admin.meals.index')->with('success', 'Meal plan added successfully!');
        } else {
            return redirect()->back('errormsg', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $mealplan = MealPlan::query()->where('id', $id)->first();
        $listData = Item::query()->where('active', 1)->get();
        $bound = $mealplan->mealItems->pluck('item_id')->toArray();
        if (!empty($mealplan)) {
            return view('backend.admin.mealplan.edit', compact(['mealplan', 'listData']))->with('bound', $bound);
        }
        return redirect()->route('admin.daily-meals.index');

    }

    public function update(UpdateRequest $request, $id)
    {
        $plan = MealPlan::query()->whereKey($id)->first();
        if ($plan != null) {
            $validated = $request->validated();
            $validated['launched'] = $request->has('launched');
            $plan->update($validated);
            Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
                $plan->images()->create(['file' => $file]);
            });
            $plan->mealItems()->delete();
            Collection::make(\request('item_id', []))->each(function ($itemId) use ($plan) {
                $plan->mealItems()->updateOrCreate(['item_id' => $itemId], ['item_id' => $itemId]);
            });
            return redirect()->route('admin.meals.index')->with('success', 'Meal plan updated successfully!');
        } else {
            return redirect()->back('errormsg', 'Something went wrong!');
        }
    }

    public function delete($id = '')
    {
        $result = array();
        $data = MealPlan::find($id);
        if (!empty($data)) {
            $data->delete();
            $result['status'] = 'success';
            $result['message'] = 'Meal plan deleted successfully!';
        } else {
            $result['status'] = 'error';
            $result['message'] = 'Something went wrong!';
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
            $result['message'] = 'Status changed successfully!';
        } else {
            $result['status'] = 'error';
            $result['message'] = 'Something went wrong!';
        }
        return json_encode($result);
    }
}
