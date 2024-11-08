@extends('admin.layout')
@section('content')
    <h2>Product Details</h2>

    <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $product->id }}</h5>

            <p><strong>Name:</strong> {{ $product->title }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> {{ $product->price }}</p>
            <p><strong>Count:</strong> {{ $product->products_count }}</p>
            <p><strong>Category:</strong> {{ $product->category->title }} </p>

            <p><strong>Genres: </strong> 
                @foreach ($product->genres as $genre)
                    {{ $genre->title }}
                @endforeach
            </p>

            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">Edit</a>
            <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger mt-3">
            </form>
        </div>
    </div>
@endsection
