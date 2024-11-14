@extends('admin.layout')
@section('content')
    <h2>Create New Product</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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

            <label for="old_price" class="mt-3">Old Price</label>
            <input name="old_price" value="{{ old('old_price') }}" type="number" class="form-control" id="old_price"
                placeholder="Enter old price">

            <label for="products_count" class="mt-3">Products Count</label>
            <input name="products_count" value="{{ old('products_count') }}" type="number" class="form-control"
                id="products_count" placeholder="Enter products count">

            <div class="custom-file mt-3">
                <label class="custom-file-label" for="image">Image</label>

                <div class="mb-2" id="imagePreviewContainer" style="display:none;">
                    <img id="imagePreview" alt="Current Image" style="max-width: 100px; max-height: 100px;">
                </div>


                <input name="image" type="file" class="custom-file-input" id="image"
                    onchange="previewImage(event)">
            </div>

            <label for="category_id" class="mt-3">Category</label>
            <select name="category_id" class="form-control" id="category_id">
                <option value="" disabled selected>Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            <label for="genres_id" class="mt-3">Genres</label>
            <select name="genres_id[]" class="form-select" multiple aria-label="multiple select example">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ is_array(old('genres_id')) && in_array($genre->id, old('genres_id')) ? 'selected' : '' }}>
                        {{ $genre->title }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
