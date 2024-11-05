@extends('admin.layout')
@section('content')
    <h2>Genres</h2>

    <a href="{{ route('genres.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle-fill"></i></a>

    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <th scope="row">{{ $genre->id }}</th>
                    <td><a href="{{ route('genres.show', $genre->id) }}">{{ $genre->title }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
