<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction 
{
    public function handle(array $orderData)
    {
        $orderSum = 0;
        for ($i = 0; $i < count($orderData['productsIdArray']); $i++) { 
            $productPrice = Product::find($orderData['productsIdArray'][$i])->price;
            $orderSum += $productPrice * $orderData['productsQuantityArray'][$i];
        }

        Order::create([
            'user_id' => Auth::id(),
            'productsId' => $orderData['productsIdArray'],
            'productsQuantity' => $orderData['productsQuantityArray'],
            'orderSum' => $orderSum,
        ]);
    }
}