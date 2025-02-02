<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create(OrderRequest $orderRequest) 
    {
        if (Auth::check()) {
            $data = $orderRequest->validated();
            
        }
    }
}
