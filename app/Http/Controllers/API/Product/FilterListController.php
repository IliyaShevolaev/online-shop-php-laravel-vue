<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;

class FilterListController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $genres = Genre::all();

        return response()->json(
            [
                'categories' => $categories,
                'genres' => $genres,
            ]
        );
    }
}
