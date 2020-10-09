<?php

namespace App\Http\Controllers;

use App\Core\Cart\State;
use App\Core\Enums\Common\DaysOfWeek;
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

	public function index (CouponRequest $request): Renderable
	{
		$coupon = $request->coupon();
		$state = new State(auth()->user());
		$total = $state->total();
		$rebates = new \stdClass();
		$rebates->weekRebate = $this->makeRebateOf($total, 10);
		$rebates->firstWeekRebate = $this->makeRebateOf($total, 10);
		$rebates->secondWeekRebate = $this->makeRebateOf($total, 10);
		if (auth()->user()->click_to_verify == 1) {
			$rebates->staffRebate = $this->makeRebateOf($total, 25);
		}
		if ($coupon != null && $coupon->isValid() && $coupon->isUsable()) {
			$coupon->incrementUsageCount();
			$rebates->coupon = $this->makeRebateOf($total, $coupon->discount, ['coupon' => $coupon]);
		}
		$totalRebate = 0;
		foreach ($rebates as $key => $rebate) {
			$totalRebate += $rebate->value;
		}
		$state->setDiscount($totalRebate);
		$state->calculateStats();
		$postalCodes = PostalCode::active()->get();
		return view('frontend.checkout')->with('state', $state)->with('rebates', $rebates)->with('postalCodes', $postalCodes);
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
					'data' => view('frontend.coupon_frame')->with('coupon', $coupon)->toHtml()
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
				'data' => view('frontend.coupon_frame')->with('coupon', null)->toHtml()
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