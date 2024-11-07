<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $categoryRequest) 
    {
        $data = $categoryRequest->validated();

        Category::firstOrCreate($data); 

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    } 

    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        $data = $categoryRequest->validated();

        $category->update($data);

        return view('admin.category.show', compact('category'));
    }

    public function delete(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index');
    }
}
