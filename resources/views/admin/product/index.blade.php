@extends('admin.layout')
@section('content')
    <h2>Products</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle-fill"></i></a>

    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Count</th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    {{-- <td><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></td> --}}
                    <td>{{ $product->title }}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category->title}}</td>
                    <td>{{$product->products_count}}</td>
                    <td><a href="{{route('products.show', $product->id)}}"><i class="bi bi-pencil"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
