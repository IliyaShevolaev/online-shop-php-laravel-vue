@extends('admin.layout')
@section('content')
    <h2>Customer Details</h2>

    <div class="card w-50">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $user->id }}</h5>

            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Surname:</strong> {{ $user->surname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Age:</strong> {{ $user->age }}</p>
            <p><strong>Gender:</strong> {{ $user->genderTitle }} </p>
            <p><strong>Address:</strong> {{ $user->address }}</p>

            <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">Edit</a>
            <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger mt-3">
            </form>
        </div>
    </div>
@endsection
