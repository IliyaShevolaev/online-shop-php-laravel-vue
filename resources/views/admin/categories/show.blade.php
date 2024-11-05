@extends('admin.layout')
@section('content')
    <p>ID: {{ $category->id }}</p>
    <p>Name: {{ $category->title }}</p>

    <div class="d-flex gap-2">
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
@endsection
