<?php

namespace App\Exceptions;

use Exception;

class EmptyCartCheckoutException extends Exception
{
	public function __construct ($message = "Please add some meals to your cart to place an order.")
	{
		parent::__construct($message);
	}
}
