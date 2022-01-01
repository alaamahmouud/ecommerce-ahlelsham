<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => $this->client,
            'name' => $this->name,
            'total_price' => $this->total_price,
            'delivery' => $this->delivery,
            'price_after_delivery' => $this->price_after_delivery,
            'products' => $this->products,
            'status' => $this->status
        ];
    }
}
