@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div id="success" style="display: none;" class="col-md-8 text-center h4 p-4 bg-success text-light rounded">
            Purchase completed successfully!
        </div>

        @if(session('message'))
            <div class="col-md-8 text-center h4 p-4 bg-success text-light rounded">
                Purchase completed successfully!
            </div> 
        @endif

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center h5">
                    Shopping Cart
                </div>

                <div class="card-body">
                    @if($items->count())

                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        @php($totalPrice = 0)
                        @foreach($items as $item)
                            @php($totalPrice += $item->price * $item->pivot->number_of_copies)

                            <tbody>
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }} $</td>
                                    <td>{{ $item->pivot->number_of_copies }}</td>
                                    <td>{{ $item->price * $item->pivot->number_of_copies }} $</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form method="post" action="{{ route('cart.remove_one', $item->id) }}">
                                                @csrf
                                                <button class="btn btn-warning btn-sm mx-1" type="submit">
                                                    <i class="fas fa-minus-circle"></i> Remove One
                                                </button>
                                            </form>

                                            <form method="post" action="{{ route('cart.remove_all', $item->id) }}">
                                                @csrf
                                                <button class="btn btn-danger btn-sm mx-1" type="submit">
                                                    <i class="fas fa-trash"></i> Remove All
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>

                    <h4 class="text-center mt-4">Total Amount: <span class="text-success">{{ $totalPrice }} $</span></h4>

                    <div class="d-flex justify-content-between align-items-start mt-4">
                        <div id="paypal-button-container"></div>
                        <p id="result-message"></p>

                        <a href="#" class="btn btn-primary ms-3">
                            <i class="fas fa-credit-card"></i> Pay with Credit Card
                        </a>
                    </div>

                    @else
                        <div class="alert alert-info text-center">
                            No books in the cart.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYGiaEe04GHEu0Z8Gz-buU9TmZCsHRK7KS3N0PTjVGW2a9rzEiDe4jwJSKkIEPyBGj__iXfGSgHGcWUm&currency=USD"></script>

    <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return fetch('/api/paypal/create-payment', {
                method: 'POST',
                body:JSON.stringify({
                    'userId' : "{{auth()->user()->id}}",
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return fetch('/api/paypal/execute-payment' , {
                method: 'POST',
                body :JSON.stringify({
                    orderId : data.orderID,
                    userId: "{{ auth()->user()->id }}",
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                $('#success').slideDown(200);
                $('.card-body').slideUp(0);
                $('span.cart-count').text(orderData.cart_count);
            });
        }
      }).render('#paypal-button-container');
    </script>

@endsection
