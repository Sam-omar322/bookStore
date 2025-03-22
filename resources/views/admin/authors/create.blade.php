@extends('theme.layout')

@section('content')
<div class="container">
    <h1>Add New Author</h1>

    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
