<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Book Store') }}</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('style')
</head>
<body>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('gallery.index') }}">📚 {{ __('BookStore') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                    <a class="nav-link {{ Route::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                            <i class="fas fa-layer-group me-1"></i> {{ __('Categories') }}
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ Route::is('publishers*') ? 'active' : '' }}" href="{{ route('publishers.index') }}">
                            <i class="fas fa-building me-1"></i> {{ __('Publishers') }}
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ Route::is('authors*') ? 'active' : '' }}" href="{{ route('authors.index') }}">
                            <i class="fas fa-user-pen me-1"></i> {{ __('Authors') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-box-open me-1"></i> {{ __('My Orders') }}
                        </a>
                    </li>
                </ul>

                {{-- User Dropdown --}}
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-2" width="28" height="28" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
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
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>
