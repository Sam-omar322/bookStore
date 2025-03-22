@extends('theme.layout')

@section('title', $title)

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ $title }}</h2>

        <a href="{{ route('books.create') }}" class="btn btn-primary mb-4">Create New Book</a>

        <div class="table-responsive">
            <table id="booksTable" class="table table-bordered table-striped">
            <thead class="table-dark">
    <tr>
        <th>#ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Published Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
    @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></td>
            <td>{{ $book->author->name ?? '-' }}</td>
            <td>{{ $book->publisher->name ?? '-' }}</td>
            <td>{{ $book->category->name ?? '-' }}</td>
            <td>${{ number_format($book->price, 2) }}</td>
            <td>{{ $book->number_of_copies }}</td>
            <td>{{ \Carbon\Carbon::parse($book->published_at)->format('Y-m-d') }}</td>

            <!-- Edit Button -->
            <td>
                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </td>

            <!-- Delete Button -->
            <td>
                <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#booksTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true
            });
        });
    </script>
@endpush
