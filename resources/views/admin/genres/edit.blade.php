@extends('admin.layout')
@section('content')
    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group w-25">
            <label> Title</label>
            <input name="title" type="text" value="{{ $genre->title }}" class="form-control" id="title"
                placeholder="Enter title">

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
@endsection
