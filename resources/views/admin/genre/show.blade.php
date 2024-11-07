@extends('admin.layout')
@section('content')

<div class="card w-50">
    <div class="card-body">
        <h5 class="card-title">ID: {{ $genre->id }}</h5>
        <p><strong>Name:</strong> {{ $genre->title }}</p>

        
        <a href="{{ route('genres.index') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('genres.delete', $genre->id) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
</div>
@endsection
