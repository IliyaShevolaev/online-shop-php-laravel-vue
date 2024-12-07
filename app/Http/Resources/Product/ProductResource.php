<?php

namespace App\Http\Resources\Product;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private function CheckFavoriteDependency() 
    {
        $user = Auth::user();

        if ($user && $user->favorites()->where('product_id', $this->id)->exists()) {
            return true;
        }

        return false;
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
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->imageUrl,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'products_count' => $this->products_count,
            'category' => $this->category,
            'genres' => $this->genres,
            'inFavorites' => $this->CheckFavoriteDependency(),
        ];
    }
}
