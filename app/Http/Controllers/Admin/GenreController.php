<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Http\Requests\Admin\GenreRequest;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('id')->get();
        
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(GenreRequest $genreRequest) 
    {
        $data = $genreRequest->validated();

        Genre::firstOrCreate($data); 

        return redirect()->route('genres.index');
    }

    public function show(Genre $genre)
    {
        return view('admin.genre.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    } 

    public function update(GenreRequest $genreRequest, Genre $genre)
    {
        $data = $genreRequest->validated();

        $genre->update($data);

        return view('admin.genre.show', compact('genre'));
    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        
        return redirect()->route('genres.index');
    }
}
