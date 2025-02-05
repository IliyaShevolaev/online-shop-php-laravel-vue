<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResourse extends JsonResource
{

    private function getUserProducts(array $productsId) 
    {
        return Product::whereIn('id', $productsId)->get();
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'orderSum' => $this->orderSum,
            'status' => $this->status,
            'products' => ProductResource::collection($this->getUserProducts($this->productsId)),
            'productsQuantity' => $this->productsQuantity,
        ];
    }
}
