<?php

namespace App\Actions\Favorites;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CreateFavoriteAction 
{
    public function handle($product_id): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$user->favorites()->where('product_id', $product_id)->exists()) {
            $user->favorites()->attach($product_id);
            return response()->json(['already_exists' => false]);
        } 

        $user->favorites()->detach($product_id);

        return response()->json(['already_exists' => true]);
    }
}