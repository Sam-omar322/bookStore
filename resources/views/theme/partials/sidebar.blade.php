<!-- Wrapper -->
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mb-4">
            <h4>📚 My Library</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    <i class="fas fa-chart-pie"></i><span class="menu-text"> Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                    <i class="fas fa-book"></i><span class="menu-text"> Books</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/publishers*') ? 'active' : '' }}" href="{{ route('publishers.index') }}">
                    <i class="fas fa-building"></i><span class="menu-text"> Publishers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/authors*') ? 'active' : '' }}" href="{{ route('authors.index') }}">
                    <i class="fas fa-user-edit"></i><span class="menu-text"> Authors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="fas fa-tags"></i><span class="menu-text"> Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i><span class="menu-text"> Users</span>
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/allorders*') ? 'active' : '' }}" href="{{ route('admin.allorders') }}">
                    <i class="fas fa-shopping-cart"></i><span class="menu-text"> Sales</span>
                </a>
            </li>
        </ul>
    </div>
</div>
