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
			return redirect()->route('payments.completed')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		} else {
			return redirect()->route('payments.cancelled')->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		}
	}

	public function cancelled ()
	{
		return redirect()->route('cart.index')->with('success', 'Your transaction was cancelled successfully!');
	}

	public function confirmed ()
	{
		return view('frontend.checkout_success');
	}

	public function failed ()
	{
		return view('frontend.checkout_failed');
	}
}