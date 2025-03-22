<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">📚 Library Dashboard</span>
        <div class="dropdown ms-auto">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i> {{ Auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
