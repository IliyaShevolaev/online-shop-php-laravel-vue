<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Category;
use App\Models\Genre;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(GenreRequest $genreRequest) 
    {
        $data = $genreRequest->validated();

        Genre::firstOrCreate($data); 

        return redirect()->route('genres.index');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    } 

    public function update(GenreRequest $categoryRequest, Category $category)
    {
        $data = $categoryRequest->validated();

        $category->update($data);

        return view('admin.categories.show', compact('category'));
    }

    public function delete(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index');
    }
}
