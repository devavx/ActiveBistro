<?php


namespace App\Http\Controllers;

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
		$product = [];
		$product['items'] = [
			[
				'name' => 'Nike Joyride 2',
				'price' => 112,
				'desc' => 'Running shoes for Men',
				'qty' => 2
			]
		];

		$product['invoice_id'] = 1;
		$product['invoice_description'] = "Order #{$product['invoice_id']} Bill";
		$product['return_url'] = route('payments.success');
		$product['cancel_url'] = route('payments.success');
		$product['total'] = 224;
		$res = $this->provider->setExpressCheckout($product);
		return redirect($res['paypal_link']);
	}

	public function success ()
	{

	}

	public function cancelled ()
	{

	}
}