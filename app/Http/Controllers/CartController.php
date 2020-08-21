<?php


namespace App\Http\Controllers;


use App\Core\Cart\State;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): Renderable
    {
        $state = new State(auth()->user());
        return view('frontend.all_meal')->with('state', $state);
    }

    public function replaceItem(string $day, int $slab, int $mealId, int $itemId): JsonResponse
    {
        $state = new State(auth()->user());
        $state->replaceItem($day, $mealId, $slab, $itemId);
        return response()->json([
            'success' => 1, 'message' => 'Meal quantity increased!', 'data' => []
        ]);
    }

    public function increase(string $day, int $mealId): JsonResponse
    {
        $state = new State(auth()->user());
        $state->increaseQuantity($day, $mealId);
        return response()->json([
            'success' => 1, 'message' => 'Meal quantity increased!', 'data' => []
        ]);
    }

    public function decrease(string $day, int $mealId): JsonResponse
    {
        $state = new State(auth()->user());
        $state->decreaseQuantity($day, $mealId);
        return response()->json([
            'success' => 1, 'message' => 'Meal quantity increased!', 'data' => []
        ]);
    }
}