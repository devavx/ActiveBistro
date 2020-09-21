<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MealPlan;
use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
	public function __construct ()
	{

	}

	public function index (): Renderable
	{
		$orderCollection = Order::query()->latest()->get();
		return view('backend.admin.orders.index')->with('orders', $orderCollection);
	}

	public function show ($key)
	{
		/**
		 * @var Order $order
		 */
		$order = Order::query()->with('user', 'items', 'address', 'secondAddress', 'items.meal')->whereKey($key)->first();
		if ($order != null) {
			return response()->json(['success' => 1, 'message' => '', 'data' => view('backend.admin.orders.show')->with('order', $order)->render()]);
		} else {
			return response()->json(['success' => 0, 'message' => '', 'data' => null]);
		}
	}

	public function delete ($key)
	{
		$order = Order::query()->whereKey($key)->first();
		$order->items()->delete();
		$order->delete();
		if ($order != null) {
			return response()->json([
				'status' => 'success',
				'message' => 'Order deleted successfully!'
			]);
		} else {
			return response()->json([
				'status' => 'error',
				'message' => 'Something went wrong!'
			]);
		}
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Order(s) deleted successfully!';
		$result['data'] = [];
		Order::query()->whereIn('id', request('orders', []))->each(function (Order $order) {
			$order->items()->delete();
			$order->delete();
		});
		return response()->json($result);
	}
}