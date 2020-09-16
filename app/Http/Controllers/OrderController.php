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
		$otherCollection = Order::query()->where('status', 'completed')->latest()->get();
		return view('frontend.my_order')->with('pendingOrders', $pendingCollection)->with('otherOrders', $otherCollection);
	}

	public function show ($key)
	{
		$order = Order::query()->with('user', 'items', 'address', 'secondAddress', 'items.meal')->whereKey($key)->first();
		if ($order != null) {
			return view('backend.admin.orders.show')->with('order', $order);
		} else {
			return redirect()->back()->with('errormsg', 'Could not find order.');
		}
	}
}