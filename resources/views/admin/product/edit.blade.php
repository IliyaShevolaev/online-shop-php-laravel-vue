@extends('admin.layout')
@section('content')
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group w-50">
            <label for="title">Title</label>
            <input name="title" value="{{ $product->title }}" type="text" class="form-control" id="title"
                placeholder="Enter title">

            <label for="description" class="mt-3">Description</label>
            <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{ $product->description }}</textarea>

            <label for="price" class="mt-3">Price</label>
            <input name="price" value="{{ $product->price }}" type="number" class="form-control" id="price"
                placeholder="Enter price">

            <label for="old_price" class="mt-3">Old Price</label>
            <input name="old_price" value="{{ old('old_price') }}" type="number" class="form-control" id="old_price"
                placeholder="Enter old price">

            <label for="products_count" class="mt-3">Products Count</label>
            <input name="products_count" value="{{ $product->products_count }}" type="number" class="form-control"
                id="products_count" placeholder="Enter products count">

            <div class="custom-file mt-3">
                <label class="custom-file-label" for="image">Image</label>

                @if ($product->image_path)
                    <div class="mb-2">
                        <img id="imagePreview" src="{{ asset('storage/' . $product->image_path) }}" alt="Current Image"
                            style="max-width: 100px; max-height: 100px;">
                    </div>
                @else
                    <div class="mb-2" id="imagePreviewContainer" style="display:none;">
                        <img id="imagePreview" alt="Current Image" style="max-width: 100px; max-height: 100px;">
                    </div>
                @endif

                <input name="image" type="file" class="custom-file-input" id="image"
                    onchange="previewImage(event)">
            </div>

            <label for="category_id" class="mt-3">Category</label>
            <select name="category_id" class="form-control" id="category_id">
                <option value="" disabled selected>Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>

            <label for="genres_id" class="mt-3">Genres</label>
            <select name="genres_id[]" class="form-select" multiple aria-label="multiple select example">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $product->genres->contains($genre->id) ? 'selected' : '' }}>
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
