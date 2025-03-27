@extends('layouts.main')

@section("style")

<style>
    .img-conver, .img-conver img {
        width: 100%;
        height: 100%;
    }
    .rating {
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }
        .rating-star {
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: left;
        }
        .rating-star:after {
            position: relative;
            font-family: "Font Awesome 5 Free";
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star:after,
        .rating-star.checked:after {
            content: '\f005';
            color: #FFCA00;
        }
        .rating:hover .rating-star:after {
            content: '\f005';
            color: lightgrey;
        }
        .rating-star:hover ~ .rating-star:after,
        .rating .rating-star:hover:after {
            content: '\f005';
            color: #FFCA00;
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
                        <li class="list-group-item"><strong>Rating:</strong>
                        <div class="d-flex gap-2">
                            <span class="score">
                                <div class="score-wrap">
                                    <span class="stars-active" style="width:{{ $book->rate()*20 }}%">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                    </span>
                                    <span class="stars-inactive">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                    </span>
                                </div>
                            </span>
                            <span>{{ $book->rate() }}</span>
                        </div>
                        </li>
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
                    @auth
                        <div class="form text-center mt-3">
                            <input id="bookId" type="hidden" value="{{ $book->id }}">
                            <button type="submit" class="btn bg-cart addCart me-2"><i class="fa fa-cart-plus"></i> أضف للسلة</button>
                            <span class="text-muted mb-3"><input class="form-control d-inline mx-auto" id="quantity" name="quantity" type="number" value="1" min="1" max="{{ $book->number_of_copies }}" style="width:30%;" required></span> 
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary mt-3">Login To Buy</a>
                    @endauth
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-5 offset-md-3">
                    @auth
                        <h4 class="mb-3">Rate This book<h4>
                        @if(auth()->user()->rated($book))
                            <div class="rating">
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 5 ? 'checked' : '' }}" data-value="5"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 4 ? 'checked' : '' }}" data-value="4"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 3 ? 'checked' : '' }}" data-value="3"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 2 ? 'checked' : '' }}" data-value="2"></span>
                                <span class="rating-star {{ auth()->user()->bookRating($book)->value == 1 ? 'checked' : '' }}" data-value="1"></span>
                            </div>
                        @else
                            <div class="rating">
                                <span class="rating-star" data-value="5"></span>
                                <span class="rating-star" data-value="4"></span>
                                <span class="rating-star" data-value="3"></span>
                                <span class="rating-star" data-value="2"></span>
                                <span class="rating-star" data-value="1"></span>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $('.rating-star').click(function() {
            
            var submitStars = $(this).attr('data-value');

            $.ajax({
                type: 'post',
                url: {{ $book->id }} + '/rate',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'value' : submitStars
                },
                success: function() {
                    location.reload();
                },
                error: function() {
                    toastr.error('Somthing went wrong!')
                },
            });
        });
    </script>


<script>
         $('.addCart').on('click', function(event) {
            var token = '{{ Session::token() }}';
            var url = "{{ route('cart.add') }}";

            event.preventDefault();

            var bookId = $(this).parents(".form").find("#bookId").val()
            var quantity = $(this).parents(".form").find("#quantity").val()


            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    quantity: quantity, 
                    id: bookId,
                    _token: token
                },
                success : function(data) {            
                    $('span.badge').text(data.num_of_product);
                    toastr.success('Book added to cart successfully');
                },
                error: function() {
                    alert('Somthing went wrong!');
                }
            })  
        });
</script>
@endsection