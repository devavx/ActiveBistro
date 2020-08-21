<?php

namespace App\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{

    public function toArray($request)
    {
        return [
            'day' => 'Sunday'
        ];
    }
}