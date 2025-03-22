@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3>{{ $title }}</h3>
        <form action="{{ route('gallery.categories.search') }}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="query" placeholder="Search categories..." value="{{ request('query') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="row">
        @forelse($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>
                                <i class="fas fa-tag me-2 text-primary"></i>
                                @if ($category->books->count() != 0)
                                    <a class="card-title text-primary" href="{{ route('gallery.categories.show', $category) }}">{{ $category->name }}</a>
                                @else
                                    {{ $category->name }}
                                @endif
                            </h5>
                            <h5>( {{$category->books->count() }} )</h5>
                        </div>
                        <p class="text-muted small mb-0">Created: {{ $category->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No categories found.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
