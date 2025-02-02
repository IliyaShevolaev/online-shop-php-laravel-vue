<?php

namespace App\Http\Controllers\API\Product;

use App\Actions\Orders\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\OrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(OrderRequest $orderRequest, CreateOrderAction $createOrderAction) 
    {
        if (Auth::check()) {
            $data = $orderRequest->validated();

            $createOrderAction->handle($data);
        }
    }
}
