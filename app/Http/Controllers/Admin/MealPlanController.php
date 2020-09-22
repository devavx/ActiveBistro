<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealPlans\Fixed\StoreRequest;
use App\Http\Requests\MealPlans\Fixed\UpdateRequest;
use App\Item;
use App\MealPlan;
use App\Models\Allergy;
use App\Models\MealPlanImage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class MealPlanController extends Controller
{
	public function index (): Renderable
	{
		$plans = MealPlan::query()->whereNull('day')->latest()->get();
		return view('backend.admin.mealplan.index')->with('plans', $plans);
	}

	public function create (): Renderable
	{
		$listData = Item::query()->where('active', 1)->get();
		$allergies = Allergy::query()->where('active', true)->get();
		return view('backend.admin.mealplan.create', compact('listData'))->with('allergies', $allergies);
	}

	public function edit ($id)
	{
		$mealplan = MealPlan::query()->where('id', $id)->first();
		$listData = Item::query()->where('active', 1)->get();
		$bound = [
			0 => $mealplan->mealItems->where('slab', 1)->pluck('item_id')->toArray(),
			1 => $mealplan->mealItems->where('slab', 2)->pluck('item_id')->toArray(),
			2 => $mealplan->mealItems->where('slab', 3)->pluck('item_id')->toArray(),
		];
		$boundAllergies = $mealplan->allergies->pluck('id')->toArray();
		$allergies = Allergy::query()->select(['id', 'name'])->where('active', true)->get();
		if (!empty($mealplan)) {
			return view('backend.admin.mealplan.edit', compact(['mealplan', 'listData']))->with('bound', $bound)->with('allergies', $allergies)->with('boundAllergies', $boundAllergies);
		}
		return redirect()->route('admin.daily-meals.index');

	}

	public function store (StoreRequest $request)
	{
		/**
		 * @var MealPlan $plan
		 */
		$plan = MealPlan::query()->create($request->validated());
		Collection::make(\request('images', []))->each(function (UploadedFile $file) use ($plan) {
			$plan->images()->create(['file' => $file]);
		});
		$slabNumber = 1;
		Collection::make(\request('item_id', []))->each(function ($slab) use ($plan, &$slabNumber, $request) {
			Collection::make($slab)->each(function ($itemId) use (&$slabNumber, $plan, $request) {
				if ($request->get('default_slab_' . $slabNumber, -1) == $itemId)
					$plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber, 'default' => true]);
				else
					$plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber]);
			});
			$slabNumber++;
		});
		Collection::make(\request('allergy_id', []))->each(function ($allergyId) use ($plan, $request) {
			$plan->allergies()->withTimestamps()->attach($allergyId);
		});
		if ($plan != null) {
			return redirect()->route('admin.meals.index')->with('success', 'Meal plan added successfully!');
		} else {
			return redirect()->back('errormsg', 'Something went wrong!');
		}
	}

	public function update (UpdateRequest $request, $id)
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
			$slabNumber = 1;
			Collection::make(\request('item_id', []))->each(function ($slab) use ($plan, &$slabNumber, $request) {
				Collection::make($slab)->each(function ($itemId) use (&$slabNumber, $plan, $request) {
					if ($request->get('default_slab_' . $slabNumber, -1) == $itemId)
						$plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber, 'default' => true]);
					else
						$plan->mealItems()->create(['item_id' => $itemId, 'slab' => $slabNumber]);
				});
				$slabNumber++;
			});
			$plan->allergies()->detach();
			Collection::make(\request('allergy_id', []))->each(function ($allergyId) use ($plan, $request) {
				$plan->allergies()->withTimestamps()->attach($allergyId);
			});
			return redirect()->route('admin.meals.index')->with('success', 'Meal plan updated successfully!');
		} else {
			return redirect()->back('errormsg', 'Something went wrong!');
		}
	}

	public function show ($id)
	{
		/**
		 * @var MealPlan $plan
		 */
		$plan = MealPlan::query()->with('allergies', 'images', 'items')->whereKey($id)->first();
		if ($plan != null) {
			return response()->json(['success' => 1, 'message' => '', 'data' => view('backend.admin.mealplan.show')->with('plan', $plan)->render()]);
		} else {
			return response()->json(['success' => 0, 'message' => '', 'data' => null]);
		}
	}

	public function delete ($id = '')
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

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Meal plan(s) deleted successfully!';
		$result['data'] = [];
		MealPlan::query()->whereNotNull('day')->whereIn('id', request('items', []))->delete();
		return response()->json($result);
	}

	public function changeStatus ($id = '')
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

	public function removeImages ($id, string $key)
	{
		MealPlanImage::query()->whereKey($key)->where('meal_plan_id', $id)->delete();
	}
}
