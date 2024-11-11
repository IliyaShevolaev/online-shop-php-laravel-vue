<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private function getGenresArray(&$data)
    {
        $genresIdArray = [];

        if (isset($data['genres_id'])) {
            $genresIdArray = $data['genres_id'];
            unset($data['genres_id']);
        }

        return $genresIdArray;
    }

    private function storeImage(&$data)
    {
        $path = $data['image']->store('uploads', 'public');
        $data['image_path'] = $path;
        unset($data['image']);
    }

    private function deleteImageIfExists(Product $product)
    {
        if (isset($product->image_path) && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }
    }


    public function store(array $data)
    {
        $genresIdArray = $this->getGenresArray($data);

        if (isset($data['image'])) {
            $this->storeImage($data);
        }

        $product = Product::create($data);
        $product->genres()->attach($genresIdArray);
        $product->save();

    }

    public function update(array $data, Product $product)
    {
        $genresIdArray = $this->getGenresArray($data);

        if (isset($data['image'])) {
            $this->deleteImageIfExists($product);
            $this->storeImage($data);
        }

        $product->update($data);

        $product->genres()->detach();
        $product->genres()->attach($genresIdArray);
        $product->save();
    }

    public function delete(Product $product)
    {
        $this->deleteImageIfExists($product);

        $product->genres()->detach();
        $product->delete();
    }
}