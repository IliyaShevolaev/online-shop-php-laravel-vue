<?php

namespace App\Http\Controllers\API\Product;

use App\Actions\Favorites\CreateFavoriteAction;
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

    public function create(Request $request, CreateFavoriteAction $createFavoriteAction)
    {
        $product_id = $request->input('product_id');
        
        return $createFavoriteAction->handle($product_id);
    }
}
