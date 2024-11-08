<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;

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
        $genres = Genre::all();

        return view('admin.product.create', compact('categories', 'genres'));
    }

    public function store(ProductRequest $productRequest) 
    {
        $data = $productRequest->validated();

        $genresIdArray = $data['genres_id'];
        unset($data['genres_id']);

        $product = Product::create($data);
        $product->genres()->attach($genresIdArray);
        $product->save();

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

