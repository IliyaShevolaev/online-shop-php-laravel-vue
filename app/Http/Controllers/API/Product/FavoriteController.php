<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $products = Auth::user()->favorites()->get();

        return ProductResource::collection($products);
    }

    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $user = Auth::user();

        if (!$user->favorites()->where('product_id', $product_id)->exists()) {
            $user->favorites()->attach($product_id);
            return response()->json(['already_exists' => 0]);
        } else {
            $user->favorites()->detach($product_id);
        }
        
        return response()->json(['already_exists' => 1]);
    }
}
