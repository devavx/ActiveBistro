<?php


namespace App\Http\Controllers;


use App\Category;
use App\Core\Cart\State;
use App\MealPlan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class CartController extends Controller {
	public function index (): Renderable {
		$state = new State(auth()->user());
		return view('frontend.all_meal')->with('state', $state);
	}

	public function items ($day): Renderable {
		$state = new State(auth()->user());
		$categories = Category::query()->where('active', 1)->get();
		$types = MealPlan::query()->with('images', 'allergies', 'items')->where('active', 1)->whereNull('day')->get();
		return view('frontend.all_item')->with('state', $state)
			->with('categories', $categories)->with('day', $day)
			->with('types', $types)->with('chosen', request('type', 'none'));
	}

	public function addItem (string $day, int $itemId): JsonResponse {
		$state = new State(auth()->user());
		$state->addItem($day, $itemId);
		return response()->json([
			'success' => 1, 'message' => 'Added/updated item successfully!', 'data' => []
		]);
	}

	public function replaceItem (string $day, int $slab, string $mealId, int $itemId): JsonResponse {
		$state = new State(auth()->user());
		$state->replaceItem($day, $mealId, $slab, $itemId);
		return response()->json([
			'success' => 1, 'message' => 'Meal plan updated successfully!', 'data' => []
		]);
	}

	public function cloneMealPlan (string $day, string $mealId): JsonResponse {
		$state = new State(auth()->user());
		$state->cloneMealPlan($day, $mealId);
		return response()->json([
			'success' => 1, 'message' => 'Duplicated meal plan for customization!', 'data' => view('frontend.main_container')->with('state', $state)->toHtml()
		]);
	}

	public function deleteMealPlan (string $day, string $mealId): JsonResponse {
		$state = new State(auth()->user());
		$state->deleteMealPlan($day, $mealId);
		return response()->json([
			'success' => 1, 'message' => 'Meal removed from cart successfully!', 'data' => view('frontend.main_container')->with('state', $state)->toHtml()
		]);
	}

	public function increaseItem (string $day, int $itemId): JsonResponse {
		$state = new State(auth()->user());
		$state->addItem($day, $itemId);
		return response()->json([
			'success' => 1, 'message' => 'Item quantity increased!', 'data' => []
		]);
	}

	public function decreaseItem (string $day, int $itemId): JsonResponse {
		$state = new State(auth()->user());
		$state->removeItem($day, $itemId);
		return response()->json([
			'success' => 1, 'message' => 'Item quantity decreased!', 'data' => []
		]);
	}

	public function deleteItem (string $day, int $itemId): JsonResponse {
		$state = new State(auth()->user());
		$state->deleteItem($day, $itemId);
		return response()->json([
			'success' => 1, 'message' => 'Item deleted successfully!', 'data' => []
		]);
	}
}