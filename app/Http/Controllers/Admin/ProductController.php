<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')->get();
    
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $productRequest) 
    {
        $data = $productRequest->validated();

        Product::create($data);

        return redirect()->route('products.index');
    } 

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {

    } 

    public function update(ProductRequest $productRequestRequest, Product $product)
    {
        
    }

    public function delete(Product $product)
    {
        $product->delete();
        
        return redirect()->route('products.index');
    }
}

