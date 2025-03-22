@extends('theme.layout')

@section('title', $title)

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ $title }}</h2>

        <div class="table-responsive">
            <table id="booksTable" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Update Role</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <!-- Update Role -->
                        <td>
                            @if(auth()->user()->isAdmin())
                                <form action="{{ route('users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            @else
                                {{ ucfirst($user->role) }}
                            @endif
                        </td>

                        <!-- Delete Button -->
                        <td>
                            @if(auth()->user()->isAdmin() && auth()->user()->id !== $user->id)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            @else
                                <div class="btn btn-sm btn-danger disabled" disabled>
                                    <i class="fas fa-trash-alt"></i> Delete
                                </div>
                            @endif
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
