<?php
return [
	'mode' => 'sandbox',
	'sandbox' => [
		'username' => "sb-xtoh53190706_api1.business.example.com",
		'password' => "NVYGHEEA9AU93F7U",
		'secret' => "EPW7x1GiEraWcAQaQjz7BDBHh6YL-BbEquFIu9dOfzXNAphfgJS7EW7SoQGMPnTr0MXopx59CkDXYEDb",
		'certificate' => storage_path("storage/app/api.sandbox.paypal.com.pem"),
		'client_id' => "AYPBAioKS19l7bbmqa5Uizkyam_FDYJGB-TiK9ajByLZlQ18tGsSIjvPO38PW0A2mv_LMUVMhvKB-oXN",
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
	'invoice_prefix' => env('PAYPAL_INVOICE_PREFIX', 'PAYPALDEMOAPP'),
];
