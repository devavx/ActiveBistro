<?php

namespace App\Http\Controllers;

use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
use App\Http\Requests\Checkout\StoreRequest;
use App\Models\Address;
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
		$this->rules = [
			'store' => [

			]
		];
	}

	public function index (): Renderable
	{
		$state = new State(auth()->user());
		return view('frontend.checkout')->with('state', $state);
	}

	public function store (StoreRequest $request): RedirectResponse
	{
		/**
		 * @var $user User
		 * @var $state State
		 * @var $address Address
		 * @var $secondAddress Address
		 */
		$state = new State(auth()->user());
		$user = auth()->user();
		$items = $state->meals();
		if ($request->hasSeparateAddresses()) {
			$addressCollection = $user->addresses()->createMany($request->addresses())->toArray();
			$address = $addressCollection[0];
			$secondAddress = $addressCollection[1];
			$user->orders()->create([
				'address_id' => $address->getKey(),
				'second_address_id' => $secondAddress->getKey(),
				'invoice_id' => $state->invoice()->id,
				'payment_slab' => $request->paymentSlab(),
				'quantity' => $items->count(),
				'sub_total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
				'total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
			]);
		} else {
			$address = $request->address();
			$address['day'] = DaysOfWeek::Sunday;
			$sunday = $address;
			$address['day'] = DaysOfWeek::Wednesday;
			$wednesday = $address;
			$sunday = $user->addresses()->create($sunday);
			$wednesday = $user->addresses()->create($wednesday);
			$user->orders()->create([
				'address_id' => $sunday->getKey(),
				'second_address_id' => $wednesday->getKey(),
				'invoice_id' => $state->invoice()->id,
				'payment_slab' => $request->paymentSlab(),
				'quantity' => $items->count(),
				'sub_total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
				'total' => $items->sum(function (\stdClass $meal) {
					return $meal->total;
				}),
			]);
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