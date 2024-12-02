@extends('admin.layout')
@section('content')
    <h2>Create New Customer</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group w-50">
            <label for="name">Name</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="name"
                placeholder="Enter name">

            <label for="surname" class="mt-3">Surname</label>
            <input name="surname" value="{{ old('surname') }}" type="text" class="form-control" id="surname"
                placeholder="Enter surname">

            <label for="email" class="mt-3">Email</label>
            <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="email"
                placeholder="Enter email">

            {{-- <label for="password" class="mt-3">Password</label>
            <input name="password" value="{{ old('password') }}" type="text" class="form-control" id="password"
                placeholder="Enter password"> --}}

            <label for="role" class="mt-3">Role</label>
            <select name="role" class="form-control" id="role">
                <option value="" disabled selected>Select role</option>
                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>User</option>
            </select>

            <label for="gender" class="mt-3">Gender</label>
            <select name="gender" class="form-control" id="gender">
                <option value="" disabled selected>Select gender</option>
                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
                <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>Not specified</option>
            </select>

            <label for="address" class="mt-3">Address</label>
            <input name="address" value="{{ old('address') }}" type="text" class="form-control" id="address"
                placeholder="Enter address">

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
@endsection
