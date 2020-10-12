<?php

namespace App\Http\Controllers;

use App\Core\Cart\State;
use App\Core\Primitives\Arrays;
use App\Exceptions\InvalidCouponException;
use App\Http\Requests\Checkout\CouponRequest;
use App\Http\Requests\Checkout\StoreRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\PostalCode;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
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
		/**
		 * @var $user User
		 */
		$user = auth()->user();
		$state = new State($user);
		if ($user->canAvailSpecialDiscount()) {
			$state->setStaffDiscount(true);
		}
		$state->recalculateStats();
		$state->update();
		$postalCodes = PostalCode::active()->get();
		return view('frontend.checkout')->with('state', $state)->with('postalCodes', $postalCodes);
	}

	public function validateCoupon (CouponRequest $request): JsonResponse
	{
		$coupon = $request->coupon();
		if ($coupon != null) {
			$state = new State(auth()->user());
			try {
				$state->setCoupon($coupon);
				$state->recalculateStats();
				$state->update();
				return response()->json([
					'success' => 1,
					'message' => 'Your coupon code is valid and has been applied!',
					'data' => view('frontend.checkout_fragment')->with('state', $state)->toHtml()
				]);
			} catch (InvalidCouponException $e) {
				return response()->json([
					'success' => 0,
					'message' => 'This coupon is either invalid or is expired! exc',
					'data' => null
				]);
			}
		} else {
			return response()->json([
				'success' => 0,
				'message' => 'This coupon is either invalid or is expired! els',
				'data' => null
			]);
		}
	}

	public function removeCoupon (): JsonResponse
	{
		$state = new State(auth()->user());
		if ($state->coupon() != null) {
			$state->setCoupon(null);
			$state->recalculateStats();
			$state->update();
			return response()->json([
				'success' => 1,
				'message' => 'Applied coupon was removed from cart!',
				'data' => view('frontend.checkout_fragment')->with('state', $state)->toHtml()
			]);
		} else {
			return response()->json([
				'success' => 0,
				'message' => 'We did\'t find any coupons applied to your cart! ',
				'data' => null
			]);
		}
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
		$items = $state->items();
//		if ($state->coupon() != null) {
//			Arrays::push($items, [
//				'name' => 'Discounts',
//				'price' => ($state->subTotal() - $state->total()) * -1,
//				'desc' => 'Coupon and other applicable discounts',
//				'qty' => 1
//			]);
//		}
		if ($request->containsMultiAddresses()) {
			$address = $user->addresses()->create($request->addresses()[0]);
			$secondAddress = $user->addresses()->create($request->addresses()[1]);
			$state->setAddress($address);
			$state->setSecondAddress($secondAddress);
		} else {
			$address = $request->address();
			$address = $user->addresses()->create($address);
			$state->setAddress($address);
			$state->setSecondAddress($address);
		}
		$state->setFirstDate($request->firstDate()['actual']);
		$state->setSecondDate($request->secondDate()['actual']);
		$state->update();
		$payload = [];
		$payload['items'] = $items;
		$payload['invoice_id'] = $state->invoice()->id;
		$payload['invoice_description'] = $state->invoice()->description;
		$payload['return_url'] = route('payments.completed');
		$payload['cancel_url'] = route('payments.cancelled');
		$payload['total'] = $state->total();
		$response = $this->provider->setExpressCheckout($payload);
		return redirect()->to($response['paypal_link']);
	}

	/**
	 * @param float $total
	 * @param float $percent
	 * @param mixed ...$extra
	 * @return object
	 */
	protected function makeRebateOf (float $total, float $percent, ...$extra): object
	{
		$base = ['value' => $percent, 'calculated' => percentOf($total, $percent)];
		$base = array_merge($base, $extra);
		return (object)$base;
	}
}