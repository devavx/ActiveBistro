<?php
return [
	'mode' => 'sandbox',
	'sandbox' => [
		'username' => "sb-xtoh53190706_api1.business.example.com",
		'password' => "Y254KMHR7YVMUSAR",
		'secret' => "AQgZci6y7P6ovJ.PjpC2gjudKlMvAq1OMljHKSmhzgI.QeyPK5pA2hOT",
		'certificate' => '',
		'app_id' => 'ActiveBistro',
	],
	'live' => [
		'username' => env('PAYPAL_LIVE_API_USERNAME', ''),
		'password' => env('PAYPAL_LIVE_API_PASSWORD', ''),
		'secret' => env('PAYPAL_LIVE_API_SECRET', ''),
		'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
		'app_id' => '',         // Used for Adaptive Payments API
	],

	'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
	'currency' => 'USD',
	'notify_url' => '', // Change this accordingly for your application.
	'locale' => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
	'invoice_prefix' => env('PAYPAL_INVOICE_PREFIX', 'ActiveBistro_Invoice_'),
	'validate_ssl' => false
];
