<?php

namespace App\Http\Controllers\API\Product;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Orders\CreateOrderAction;
use App\Http\Requests\Product\OrderRequest;
use App\Http\Resources\Order\OrderResourse;
use App\Http\Resources\Order\OrdersResourse;

class OrderController extends Controller
{
    public function index () 
    {
        if (Auth::check()) {
            return OrdersResourse::collection(Order::where('user_id', Auth::id())->orderBy('id', 'asc')->get());
        }
    }

    public function show(Order $order) 
    {
        if (Auth::id() == $order->user_id) {
            return new OrderResourse($order);
        }
    }

    public function create(OrderRequest $orderRequest, CreateOrderAction $createOrderAction) 
    {
        if (Auth::check()) {
            $data = $orderRequest->validated();

            $createOrderAction->handle($data);
        }
    }
}
