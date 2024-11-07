@extends('admin.layout')
@section('content')
    <h2>Customers</h2>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus-circle-fill"></i></a>

    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->genderTitle }}</td>
                    <td>{{ $user->address }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}"><i class="bi bi-person-lines-fill"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
