<?php


namespace App\Resources\MealPlans\Daily;


use App\Core\Enums\Common\DaysOfWeek;
use App\Resources\MealPlans\Items\ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'day' => DaysOfWeek::getKey($this->day),
            'items' => ItemResource::collection($this->items)
        ];
    }
}