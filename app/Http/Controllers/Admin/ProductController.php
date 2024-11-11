<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\Admin\ProductService;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    public function index()
    {
        $products = Product::orderBy('id')->get();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $genres = Genre::all();

        return view('admin.product.create', compact('categories', 'genres'));
    }

    public function store(ProductRequest $productRequest)
    {
        $data = $productRequest->validated();

        $this->service->store($data);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $genres = Genre::all();

        return view('admin.product.edit', compact('product', 'categories', 'genres'));
    }

    public function update(ProductRequest $productRequest, Product $product)
    {
        $data = $productRequest->validated();

        $this->service->update($data, $product);

        return redirect()->route('products.index');
    }

    public function delete(Product $product)
    {
        $this->service->delete($product);

        return redirect()->route('products.index');
    }
}
