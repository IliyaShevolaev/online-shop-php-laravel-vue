@extends('admin.layout')
@section('content')

<div class="card w-50">
    <div class="card-body">
        <h5 class="card-title">ID: {{ $category->id }}</h5>
        <p><strong>Name:</strong> {{ $category->title }}</p>

        
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="d-inline">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
</div>
@endsection
