@extends('layouts.main')
@section('title', 'My Orders')

@section('style')
    <style>
        .product-image {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
        }
        .score-wrap {
            display: inline-block;
            position: relative;
            font-size: 1.2rem;
        }
        .stars-active {
            color: gold;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
        }
        .stars-inactive {
            color: #ddd;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-primary mb-4" href="{{ route('gallery.index') }}">
                    <i class="fas fa-plus"></i> Purchase New Book
                </a>
                @if($myBooks->count())
                    @foreach($myBooks as $book)
                        <div class="row p-3 mb-3 bg-light border rounded shadow-sm">
                            <div class="col-md-3 text-center">
                                <img class="img-fluid rounded product-image" src="{{ asset('storage/' . $book->cover_image) }}">
                            </div>
                            <div class="col-md-6 d-flex flex-column justify-content-center">
                                <h5><a href="{{ route('book.details', $book) }}" class="text-decoration-none text-dark">{{ $book->title }}</a></h5>
                                <div class="ratings">
                                    <div class="score-wrap">
                                        <span class="stars-active" style="width:{{ $book->rate() * 20 }}%">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </span>
                                        <span class="stars-inactive">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                                <p class="mt-2 mb-1 text-muted">Category: {{ $book->category != null ? $book->category->name : 'N/A' }}</p>
                                <p class="text-muted">Purchase Date: {{ $book->pivot->created_at->diffForHumans() }}</p>
                                <p class="mb-0">Number of Copies: <strong>{{ $book->pivot->number_of_copies }}</strong></p>
                            </div>
                            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center border-start">
                                <h4 class="text-primary">${{ $book->pivot->price }}</h4>
                                <h6 class="text-success">Total: ${{ $book->pivot->number_of_copies * $book->pivot->price }}</h6>
                                <a href="{{ route('book.details', $book) }}" class="btn btn-outline-primary btn-sm mt-3">View Details</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning text-center" role="alert">
                        No purchases yet. All products you purchase will appear here.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection