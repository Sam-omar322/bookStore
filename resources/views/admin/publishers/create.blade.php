@extends('theme.layout')
@section('content')
<div class="container">
    <h1>Add New Publisher</h1>

    <form action="{{ route('publishers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Publisher Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address (optional)</label>
            <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Publisher</button>
        <a href="{{ route('publishers.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
