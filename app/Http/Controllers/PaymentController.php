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
		$payload['invoice_description'] = "Order #{$payload['invoice_id']} Bill";
		$payload['return_url'] = route('payments.success');
		$payload['cancel_url'] = route('payments.success');
		$payload['total'] = $state->total();
		$res = $this->provider->setExpressCheckout($payload);
		return redirect($res['paypal_link']);
	}

	public function success ()
	{

	}

	public function cancelled ()
	{

	}
}