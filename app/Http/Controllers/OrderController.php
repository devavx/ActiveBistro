<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
	public function __construct ()
	{

	}

	public function index (): Renderable
	{
		$pendingCollection = Order::query()->where('status', 'pending')->latest()->get();
		$activeCollection = Order::query()->where('status', 'placed')->latest()->get();
		$completedCollection = Order::query()->where('status', 'completed')->latest()->get();
		return view('frontend.my_order')->with('pendingOrders', $pendingCollection)->with('completedOrders', $completedCollection)->with('activeOrders', $activeCollection);
	}

	public function show ($key)
	{
		/**
		 * @var Order $order
		 */
		$order = Order::query()->with('user', 'items', 'address', 'secondAddress', 'items.meal')->whereKey($key)->first();
		if ($order != null) {
			return response()->json(['success' => 1, 'message' => '', 'data' => view('frontend.order_details')->with('order', $order)->render()]);
		} else {
			return response()->json(['success' => 0, 'message' => '', 'data' => null]);
		}
	}
}