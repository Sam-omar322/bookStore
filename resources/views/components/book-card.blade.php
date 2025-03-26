<div class="card h-100 shadow-sm border-0">
    <a href="#">
        <img src="/storage/{{ $book->cover_image }}" class="card-img-top" alt="{{ $book->title }}">
    </a>

    <div class="card-body d-flex flex-column">
        <a href="{{ route('book.details', $book) }}" class="card-title">{{ $book->title }}</a>

        <a href="{{ route('categories.show', $book->category) }}" class="text-center card-title mb-1">{{ $book->category->name }}</a>

        {{-- Rating --}}
        <div class="mx-auto mb-2">
            @php
                $rating = $book->ratings->avg('rating') ?? 0;
                $fullStars = floor($rating);
                $halfStar = $rating - $fullStars >= 0.5;
            @endphp
            @for ($i = 0; $i < $fullStars; $i++)
                <i class="fas fa-star text-warning"></i>
            @endfor
            @if ($halfStar)
                <i class="fas fa-star-half-alt text-warning"></i>
            @endif
            <div class="d-flex justify-content-center gap-2">
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
        </div>

        <h5 class="text-center mt-auto mb-3">${{ $book->price }}</h5>

        <div>
            @auth
            <div class="form">
                <input id="bookId" type="hidden" value="{{ $book->id }}">
                <input class="form-control d-inline mx-auto" id="quantity" name="quantity" type="hidden" value="1" min="1" max="{{ $book->number_of_copies }}" style="width:30%;" required>
                <button type="submit" class="btn btn-primary w-100 addCart">
                    <i class="fas fa-cart-plus me-1"></i> Add to Cart
                </button>
            </div>
            @endauth
        </div>
    </div>
</div>

@section('script')
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
                    alert('Book added to cart successfully');
                },
                error: function() {
                    alert('Somthing went wrong!');
                }
            })  
        });
</script>
@endsection