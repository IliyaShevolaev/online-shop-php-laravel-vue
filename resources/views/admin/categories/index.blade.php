@extends('admin.layout')
@section('content')
    <h2>Categories</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle-fill"></i></a>

    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->title }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
