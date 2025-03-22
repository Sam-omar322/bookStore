@extends('theme.layout')
@section('content')
<div class="container">
<h2 class="mb-4">{{ $title }}</h2>
    <a href="{{ route('publishers.create') }}" class="btn btn-success mb-3">Add Publisher</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publishers as $publisher)
                <tr>
                    <td>{{ $publisher->id }}</td>
                    <td>{{ $publisher->name }}</td>
                    <td>{{ $publisher->address }}</td>
                    <td>
                        <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
