<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}