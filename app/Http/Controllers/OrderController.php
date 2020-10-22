<?php

namespace App\Http\Controllers;

use App\Core\Enums\Common\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
	public function __construct ()
	{

	}

	public function index (): Renderable
	{
		$pendingCollection = $this->user()->orders()->whereIn('status', [OrderStatus::Pending])->latest()->get();
		$activeCollection = $this->user()->orders()->whereIn('status', [OrderStatus::Dispatched, OrderStatus::Placed, OrderStatus::Received])->latest()->get();
		$completedCollection = $this->user()->orders()->whereIn('status', [OrderStatus::Delivered])->latest()->get();
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