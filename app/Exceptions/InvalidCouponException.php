<?php

namespace App\Exceptions;

use Exception;

class InvalidCouponException extends Exception
{
	public function __construct ($message = "This coupon is either invalid or is expired!")
	{
		parent::__construct($message);
	}
}
