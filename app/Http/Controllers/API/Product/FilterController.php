<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class FilterController extends Controller
{
    public function __invoke(FilterRequest $filterRequest)
    {
        $data = $filterRequest->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->get();

        return ProductResource::collection($products);
    }
}
