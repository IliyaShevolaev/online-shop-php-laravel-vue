@extends('admin.layout')
@section('content')
    <h2>Edit Customer</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group w-50">
            <label for="name">Name</label>
            <input name="name" value="{{ $user->name }}" type="text" class="form-control" id="name"
                placeholder="Enter name">

            <label for="surname" class="mt-3">Surname</label>
            <input name="surname" value="{{ $user->surname }}" type="text" class="form-control" id="surname"
                placeholder="Enter surname">

            <label for="role" class="mt-3">Role</label>
            <select name="role" class="form-control" id="role">
                <option value="" disabled selected>Select role</option>
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
            </select>

            <label for="age" class="mt-3">Age</label>
            <input name="age" value="{{ $user->age }}" type="number" class="form-control" id="age"
                placeholder="Enter age">

            <label for="gender" class="mt-3">Gender</label>
            <select name="gender" class="form-control" id="gender">
                <option value="" disabled selected>Select gender</option>
                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female</option>
                <option value="3" {{ $user->gender == 3 ? 'selected' : '' }}>Not specified</option>
            </select>

            <label for="address" class="mt-3">Address</label>
            <input name="address" value="{{ $user->address }}" type="text" class="form-control" id="address"
                placeholder="Enter address">

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
@endsection
