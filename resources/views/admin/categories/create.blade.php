@extends('theme.layout')
@section('title', 'Create Category')

@section('content')
    <div class="container mt-4">
        <h2>Create New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create Category</button>
        </form>
    </div>
@endsection
