<?php


namespace App\Http\Controllers;

use App\Core\Cart\State;
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
		$payload['invoice_id'] = $state->invoiceId();
		$payload['invoice_description'] = "Order_{$payload['invoice_id']}";
		$payload['return_url'] = route('payments.success');
		$payload['cancel_url'] = route('payments.cancelled');
		$payload['total'] = $state->total();
		$response = $this->provider->setExpressCheckout($payload);
		return redirect()->to($response['paypal_link']);
	}

	public function success ()
	{
		$response = $this->provider->getExpressCheckoutDetails(request('token'));
		if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
			return view('frontend.checkout_success');
		} else {
			return view('frontend.checkout_failed');
		}
	}

	public function cancelled ()
	{
		return redirect()->route('cart.index')->with('errormsg', 'Your transaction was cancelled successfully!');
	}
}