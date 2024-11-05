<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(GenreRequest $genreRequest) 
    {
        $data = $genreRequest->validated();

        Genre::firstOrCreate($data); 

        return redirect()->route('genres.index');
    }

    public function show(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    } 

    public function update(genreRequest $genreRequest, Genre $genre)
    {
        $data = $genreRequest->validated();

        $genre->update($data);

        return view('admin.genres.show', compact('genre'));
    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        
        return redirect()->route('genres.index');
    }
}
