@extends('admin.layout')
@section('content')
    <p>ID: {{ $genre->id }}</p>
    <p>Name: {{ $genre->title }}</p>

    <div class="d-flex gap-2">
        <a href="{{ route('genres.index') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('genres.delete', $genre->id) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
@endsection
