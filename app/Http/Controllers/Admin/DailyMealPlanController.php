<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealPlans\Daily\StoreRequest;
use App\Http\Requests\MealPlans\Daily\UpdateRequest;
use App\Item;
use App\MealPlan;
use App\Models\MealPlanImage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class DailyMealPlanController extends Controller
{
    public function index(): Renderable
    {
        $plans = MealPlan::query()->whereNotNull('day')->get();
        $abc = $plans;
        return view('backend.admin.dailymealplan.index')->with('plans', $plans);
    }

    public function create(): Renderable
    {
        $listData = Item::query()->where('active', 1)->get();
        return view('backend.admin.dailymealplan.create', compact('listData'));
    }

    public function edit($id)
    {
        $mealplan = MealPlan::query()->where('id', $id)->first();
        $listData = Item::query()->where('active', 1)->get();
        $bound = [
            0 => $mealplan->mealItems->where('slab', 1)->pluck('item_id')->toArray(),
            1 => $mealplan->mealItems->where('slab', 2)->pluck('item_id')->toArray(),
            2 => $mealplan->mealItems->where('slab', 3)->pluck('item_id')->toArray(),
        ];
        if (!empty($mealplan)) {
            return view('backend.admin.dailymealplan.edit', compact(['mealplan', 'listData']))->with('bound', $bound);
        }
        return redirect()->route('admin.daily-meals.index');

    }

    public function store(StoreRequest $request)
    {
        /**
         * @var MealPlan $plan
         */
        $plan = MealPlan::query()->create($request->validated());
        Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
            $plan->images()->create(['file' => $file]);
        });
        $slabNumber = 1;
        Collection::make(\request('item_id', []))->each(function ($slab) use ($plan, &$slabNumber) {
            Collection::make($slab)->each(function ($itemId) use (&$slabNumber, $plan) {
                $plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber]);
            });
            $slabNumber++;
        });
        if ($plan != null) {
            return redirect()->route('admin.daily-meals.index')->with('success', 'Meal plan added successfully!');
        } else {
            return redirect()->back('errormsg', 'Something Went Wrong!');
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @var MealPlan $plan
         */
        $plan = MealPlan::query()->whereKey($id)->first();
        if ($plan != null) {
            $validated = $request->validated();
            $validated['launched'] = $request->has('launched');
            $plan->update($validated);
            Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
                $plan->images()->create(['file' => $file]);
            });
            $plan->mealItems()->delete();
            $slabNumber = 1;
            Collection::make(\request('item_id', []))->each(function ($slab) use ($plan, &$slabNumber) {
                Collection::make($slab)->each(function ($itemId) use (&$slabNumber, $plan) {
                    $plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber]);
                });
                $slabNumber++;
            });
            return redirect()->route('admin.daily-meals.index')->with('success', 'Meal plan updated successfully!');
        } else {
            return redirect()->back('errormsg', 'Something went wrong!');
        }
    }

    public function show($id)
    {
        /**
         * @var MealPlan $plan
         */
        $plan = MealPlan::query()->whereKey($id)->first();
        if ($plan != null) {
            return response()->json(['success' => 1, 'message' => '', 'data' => view('backend.admin.dailymealplan.show')->with('plan', $plan)->render()]);
        } else {
            return response()->json(['success' => 0, 'message' => '', 'data' => null]);
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

    public function removeImages($id, string $key)
    {
        MealPlanImage::query()->whereKey($key)->where('meal_plan_id', $id)->delete();
    }
}
