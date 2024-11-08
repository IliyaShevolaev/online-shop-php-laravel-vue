@extends('admin.layout')
@section('content')
    <h2>Create New Product</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group w-50">
            <label for="title">Title</label>
            <input name="title" value="{{ old('title') }}" type="text" class="form-control" id="title"
                placeholder="Enter title">

            <label for="description" class="mt-3">Description</label>
            <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{ old('description') }}</textarea>

            <label for="price" class="mt-3">Price</label>
            <input name="price" value="{{ old('price') }}" type="number" class="form-control" id="price"
                placeholder="Enter price">

            <label for="products_count" class="mt-3">Products Count</label>
            <input name="products_count" value="{{ old('products_count') }}" type="number" class="form-control" id="products_count"
                placeholder="Enter products count">

            <label for="category_id" class="mt-3">Category</label>
            <select name="category_id" class="form-control" id="category_id">
                <option value="" disabled selected>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>
@endsection
