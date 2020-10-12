<?php

namespace App\Http\Controllers;

use App\Core\Cart\State;
use App\Models\Order;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{
	/**
	 * @var null | ExpressCheckout
	 */
	protected $provider = null;

	public function __construct ()
	{
		$this->provider = new ExpressCheckout();
	}

	public function initiate ()
	{
		$state = new State(auth()->user());
		$payload['items'] = $state->items();
		$payload['invoice_id'] = $state->invoice();
		$payload['invoice_description'] = "Order_{$payload['invoice_id']}";
		$payload['return_url'] = route('payments.completed');
		$payload['cancel_url'] = route('payments.cancelled');
		$payload['total'] = $state->total();
		$response = $this->provider->setExpressCheckout($payload);
		return redirect()->to($response['paypal_link']);
	}

	public function completed ()
	{
		$response = $this->provider->getExpressCheckoutDetails(request('token'));
		if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
			return redirect()->route('payments.confirmed')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		} else {
			return redirect()->route('payments.failed')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		}
	}

	public function cancelled ()
	{
		$this->makeOrder(new State($this->user()));
		return redirect()->route('cart.index')->with('success', 'Your transaction was cancelled successfully!');
	}

	public function confirmed ()
	{
		$this->makeOrder(new State($this->user()))->update(['status' => 'placed']);
		return view('frontend.checkout_success');
	}

	public function failed ()
	{
		$this->makeOrder(new State($this->user()));
		return view('frontend.checkout_failed');
	}

	/**
	 * @param State $state
	 * @return Order
	 */
	protected function makeOrder (State $state): Order
	{
		$items = $state->meals();
		$order = $this->user()->orders()->create([
			'address_id' => $state->address()->getKey(),
			'second_address_id' => $state->address()->getKey(),
			'invoice_id' => $state->invoice()->id,
			'coupon_code' => $state->coupon() != null ? $state->coupon()->code : null,
			'payment_slab' => $state->paymentSlab(),
			'quantity' => $items->count(),
			'sub_total' => $state->subTotal(),
			'total' => $state->total(),
			'start_date' => $state->firstDate()
		]);
		$items->each(function (\stdClass $meal) use ($order) {
			$items = collect($meal->items)->where('chosen', true);
			$order->items()->create([
				'meal_plan_id' => $meal->id,
				'items' => $items->toArray(),
				'quantity' => 1,
				'total' => $items->sum(function (\stdClass $item) {
					return $item->selling_price ?? 0;
				})
			]);
		});
		return $order;
	}
}