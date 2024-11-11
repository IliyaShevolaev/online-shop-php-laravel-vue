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

        $genresIdArray = [];
        if (isset($data['genres_id'])) {
            $genresIdArray = $data['genres_id'];
            unset($data['genres_id']);
        }

        if ($productRequest->hasFile('image')) {
            $path = $productRequest->file('image')->store('uploads', 'public');
            $data['image_path'] = $path;
        }
        unset($data['image']);

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
        $categories = Category::all();
        $genres = Genre::all();

        return view('admin.product.edit', compact('product', 'categories', 'genres'));
    } 

    public function update(ProductRequest $productRequest, Product $product)
    {
        $data = $productRequest->validated();

        $genresIdArray = [];
        if (isset($data['genres_id'])) {
            $genresIdArray = $data['genres_id'];
            unset($data['genres_id']);
        }

        if ($productRequest->hasFile('image')) {
            $path = $productRequest->file('image')->store('uploads', 'public');
            $data['image_path'] = $path;
        }
        unset($data['image']);

        $product->update($data);

        $product->genres()->detach();
        $product->genres()->attach($genresIdArray);
        $product->save();

        return redirect()->route('products.index');
    }

    public function delete(Product $product)
    {
        $product->genres()->detach();
        $product->delete();
        
        return redirect()->route('products.index');
    }
}

