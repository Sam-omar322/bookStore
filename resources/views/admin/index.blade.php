@extends('theme.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Welcome to the Dashboard</h2>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-book fa-2x text-primary mb-2"></i></h5>
                        <h3>{{ $n_of_books }}</h3>
                        <p class="text-muted">Total Books</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-layer-group fa-2x text-success mb-2"></i></h5>
                        <h3>{{ $n_of_categories }}</h3>
                        <p class="text-muted">Total Categories</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-user-edit fa-2x text-warning mb-2"></i></h5>
                        <h3>{{ $n_of_authors }}</h3>
                        <p class="text-muted">Total Authors</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-building fa-2x text-danger mb-2"></i></h5>
                        <h3>{{ $n_of_publishers }}</h3>
                        <p class="text-muted">Total Publishers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
