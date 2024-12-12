<?php

namespace App\Http\Controllers\API\Product;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        $products = $cartItems->pluck('product');

        return ProductResource::collection($products);
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product_id,
            'price' => Product::find($product_id)->price,
            'quantity' => 1,
        ]);
    }
}
