<?php

namespace App\Http\Controllers;

use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
use App\Http\Requests\Checkout\StoreRequest;
use App\Models\Address;
use App\Models\Order;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutController extends Controller
{
	/**
	 * @var null | ExpressCheckout
	 */
	protected $provider = null;

	/**
	 * @var array[]
	 */
	protected $rules;

	public function __construct ()
	{
		$this->provider = new ExpressCheckout();
	}

	public function index (): Renderable
	{
		$state = new State(auth()->user());
		$total = $state->total();
		$rebates = new \stdClass();
		$rebates->weekRebate = (object)['value' => 10, 'calculated' => percentOf($total, 10)];
		$rebates->firstWeekRebate = (object)['value' => 10, 'calculated' => percentOf($total, 10)];
		$rebates->secondWeekRebate = (object)['value' => 10, 'calculated' => percentOf($total, 10)];
		if (auth()->user()->click_to_verify == 1) {
			$rebates->staffRebate = (object)['value' => 25, 'calculated' => percentOf($total, 25)];
		}
		$totalRebate = 0;
		foreach ($rebates as $key => $rebate) {
			$totalRebate += $rebate->value;
		}
		$state->setDiscount($totalRebate);
		$state->calculateStats();
		return view('frontend.checkout')->with('state', $state)->with('rebates', $rebates);
	}

	public function store (StoreRequest $request): RedirectResponse
	{
		/**
		 * @var $user User
		 * @var $state State
		 * @var $address Address
		 * @var $secondAddress Address
		 * @var $order Order
		 */
		$state = new State(auth()->user());
		$user = auth()->user();
		$items = $state->meals();
		if ($request->containsMultiAddresses()) {
			$addressCollection = $user->addresses()->createMany($request->addresses())->toArray();
			$address = $addressCollection[0];
			$secondAddress = $addressCollection[1];
			$order = $user->orders()->create([
				'address_id' => $address->getKey(),
				'second_address_id' => $secondAddress->getKey(),
				'invoice_id' => $state->invoice()->id,
				'coupon_code' => $request->coupon()->code,
				'payment_slab' => $request->paymentSlab(),
				'quantity' => $items->count(),
				'sub_total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
				'total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
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
		} else {
			$address = $request->address();
			$address['day'] = DaysOfWeek::Sunday;
			$sunday = $address;
			$address['day'] = DaysOfWeek::Wednesday;
			$wednesday = $address;
			$sunday = $user->addresses()->create($sunday);
			$wednesday = $user->addresses()->create($wednesday);
			$order = $user->orders()->create([
				'address_id' => $sunday->getKey(),
				'second_address_id' => $wednesday->getKey(),
				'invoice_id' => $state->invoice()->id,
				'coupon_code' => $request->coupon()->code,
				'payment_slab' => $request->paymentSlab(),
				'quantity' => $items->count(),
				'sub_total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
				'total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
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
		}
		$payload = [];
		$payload['items'] = $state->items();
		$payload['invoice_id'] = $state->invoice()->id;
		$payload['invoice_description'] = $state->invoice()->description;
		$payload['return_url'] = route('payments.completed');
		$payload['cancel_url'] = route('payments.cancelled');
		$payload['total'] = $state->total();
		$response = $this->provider->setExpressCheckout($payload);
		return redirect()->to($response['paypal_link']);
	}
}