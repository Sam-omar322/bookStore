<nav class="navbar navbar-expand-lg border-bottom shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">📚 Library Dashboard</span>
        <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <img class="rounded-circle me-2" width="28" height="28" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                @if (Auth::user()->isAdmin())
                <li><a class="dropdown-item" href="{{ route('gallery.index') }}">{{ __('Go To Store') }}</a></li>
                <li><hr class="dropdown-divider"></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">{{ __('Logout') }}</button>
                    </form>
                </li>
            </ul>
        </li>
        </ul>
    </div>
</nav>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>