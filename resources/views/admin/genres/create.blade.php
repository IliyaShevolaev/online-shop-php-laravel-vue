@extends('admin.layout')
@section('content')
    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="form-group w-25">
            <label> Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter title">

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
