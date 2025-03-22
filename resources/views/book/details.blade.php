@extends('layouts.main')

@section("style")

<style>
    .img-conver, .img-conver img {
        width: 100%;
        height: 100%;
    }
</style>

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg p-4 mb-5 rounded border-0">
            <div class="row">
                {{-- Left Side: Book Info --}}
                <div class="col-md-8">
                    <h2 class="mb-3">{{ $book->title }}</h2>
                    <p class="text-muted">{{ $book->description }}</p>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item"><strong>ISBN:</strong> {{ $book->isbn ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Category:</strong> <a class="text-decoration-none text-dark">{{ $book->category->name ?? 'N/A' }}</a></li>
                        <li class="list-group-item"><strong>Publisher:</strong> {{ $book->publisher->name ?? 'N/A' }}</li>
                        <li class="list-group-item">
                            <strong>Authors:</strong>
                            @if ($book->authors->count())
                                <ul class="ps-3">
                                    @foreach($book->authors as $author)
                                        <li>{{ $author->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span>N/A</span>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <strong>Rating:</strong>
                            {{ $book->ratings->avg('rating') ? number_format($book->ratings->avg('rating'), 1) . ' / 5' : 'No ratings yet' }}
                        </li>
                        <li class="list-group-item"><strong>Price:</strong> ${{ number_format($book->price, 2) }}</li>
                        <li class="list-group-item"><strong>Copies Available:</strong> {{ $book->number_of_copies }}</li>
                        <li class="list-group-item"><strong>Bought:</strong>
                            @if($book->bought)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </li>
                    </ul>
                </div>

                {{-- Right Side: Optional Book Cover / Actions --}}
                <div class="col-md-4 text-center d-flex flex-column justify-content-center align-items-center">
                    @if ($book->cover_image)
                    <div class="img-conver">
                        <img src="/storage/{{ $book->cover_image }}" alt="book cover">
                    </div>
                    @else
                    <i class="fas fa-book-open fa-7x text-primary mb-4"></i>
                    @endif
                    <a href="#" class="btn btn-outline-primary mt-3">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
