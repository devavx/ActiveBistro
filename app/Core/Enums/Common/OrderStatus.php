<?php

namespace App\Core\Enums\Common;

use BenSampo\Enum\Enum;

class OrderStatus extends Enum
{
	const Placed = "placed";
	const Pending = "pending";
	const Received = "received";
	const Dispatched = "dispatched";
	const Delivered = "delivered";
}