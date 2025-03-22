@extends('theme.layout')
@section('title', 'Edit Book')

@section('content')
<div class="container mt-4">
<h2>Edit Book</h2>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- ISBN -->
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
            @error('isbn')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $book->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="" disabled>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Publisher -->
        <div class="mb-3">
            <label for="publish_id" class="form-label">Publisher</label>
            <select class="form-control" id="publish_id" name="publish_id">
                <option value="" disabled>Select Publisher</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publish_id', $book->publish_id) == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
            @error('publish_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Authors (Multiple) -->
        <div class="mb-3">
            <label for="authors" class="form-label">Authors</label>
            <select class="form-control" id="authors" name="authors[]" multiple>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" 
                        {{ in_array($author->id, old('authors', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('authors')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Publish Year -->
        <div class="mb-3">
            <label for="publish_year" class="form-label">Publish Year</label>
            <input type="number" class="form-control" id="publish_year" name="publish_year" value="{{ old('publish_year', $book->publish_year) }}">
            @error('publish_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Number of Pages -->
        <div class="mb-3">
            <label for="number_of_pages" class="form-label">Number of Pages</label>
            <input type="number" class="form-control" id="number_of_pages" name="number_of_pages" value="{{ old('number_of_pages', $book->number_of_pages) }}">
            @error('number_of_pages')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Number of Copies -->
        <div class="mb-3">
            <label for="number_of_copies" class="form-label">Number of Copies</label>
            <input type="number" class="form-control" id="number_of_copies" name="number_of_copies" value="{{ old('number_of_copies', $book->number_of_copies) }}">
            @error('number_of_copies')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $book->price) }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cover Image -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Preview -->
        @if($book->cover_image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current Image" style="width: 400px; height: 600px;">
            </div>
        @endif

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Book</button>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        document.getElementById('cover_image').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the selected file
            const reader = new FileReader();

            // Event handler for when the file is read
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                img.style.display = 'block'; // Show the image
                img.src = e.target.result; // Set the image source to the file data
            };

            // If a file is selected, read it
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
