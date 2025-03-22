@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3>{{ $title }}</h3>
        <form action="{{ route('gallery.authors.search') }}" method="GET" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="query" placeholder="Search authors..." value="{{ request('query') }}">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="row">
        @forelse($authors as $author)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>
                                <i class="fas fa-user me-2 text-primary"></i>
                                @if ($author->books->count() != 0)
                                <a class="card-title text-primary" href="{{ route('gallery.authors.show', $author) }}">{{ $author->name }}</a>
                                @else
                                {{ $author->name }}
                                @endif
                            </h5>
                            <h5>({{ $author->books->count() }})</h5>
                        </div>
                        <p class="text-muted small mb-0">Created: {{ $author->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No authors found.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
