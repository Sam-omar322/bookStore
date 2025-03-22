@extends('theme.layout')
@section('content')
<div class="container">
    <h1>Edit Publisher</h1>

    <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Publisher Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $publisher->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address', $publisher->address) }}</textarea>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Publisher</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
