@extends('theme.layout')

@section('heading')
All Purchases
@endsection

@section('content')
<div class="row">
    <h2 class="mb-4">All Purchases</h2>
    <div class="col-md-12">
        <table id="books-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead class="table-dark">
                <tr>
                    <th>Buyer</th>
                    <th>Book</th>
                    <th>Price</th>
                    <th>Number of Copies</th>
                    <th>Total Price</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($allBooks as $order)
                    <tr>
                        <td>{{ $order->user::find($order->user_id)->name }}</td>
                        <td><a href="{{ route('book.details', $order->book_id) }}">{{ $order->book::find($order->book_id)->title }}</a></td>
                        <td>{{ $order->price }}$</td>
                        <td>{{ $order->number_of_copies }}</td>
                        <td>{{ $order->price * $order->number_of_copies}}$</td>
                        <td>{{  $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#books-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection