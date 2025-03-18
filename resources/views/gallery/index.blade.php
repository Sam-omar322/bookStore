@extends('layouts.main')

@section('style')
<style>
.card .card-title {
    text-decoration: none;
}

.card .card-title:hover {
    color: #0d6efd;
}
</style>
@endsection

@section('content')
    <x-SearchBar />
    @if(request('query'))
    <p class="text-muted">Found {{ $books->total() }} results for "<strong>{{ request('query') }}</strong>"</p>
    @endif
    <h2 class="mb-4">{{ $title }}</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($books as $book)
            <div class="col">
                <x-book-card :book="$book" />
            </div>
        @empty
            <div class="col">
                <p>No books available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection