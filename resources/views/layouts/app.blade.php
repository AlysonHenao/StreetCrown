{{-- Author: Alyson Henao --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', __('layout.app_title'))</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                {{ __('layout.brand') }}
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="{{ __('layout.toggle_navigation') }}"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    <a class="nav-link" href="{{ route('home.index') }}">
                        {{ __('layout.home') }}
                    </a>

                    @if(Route::has('product.index'))
                        <a class="nav-link" href="{{ route('product.index') }}">
                            {{ __('layout.products') }}
                        </a>
                    @endif

                    @if(Route::has('cart.index'))
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            {{ __('layout.cart') }}
                        </a>
                    @endif

                    @auth
                        @if(Route::has('order.index'))
                            <a class="nav-link" href="{{ route('order.index') }}">
                                {{ __('layout.orders') }}
                            </a>
                        @endif

                        @if(auth()->user()->role === 'admin' && Route::has('admin.index'))
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                {{ __('layout.admin_panel') }}
                            </a>
                        @endif

                        @if(Route::has('logout'))
                            <form method="POST" action="{{ route('logout') }}" class="d-inline ms-lg-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    {{ __('layout.logout') }}
                                </button>
                            </form>
                        @endif
                    @else
                        @if(Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">
                                {{ __('layout.login') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-secondary text-white py-4">
        <div class="container text-center">
            <h1 class="h3 mb-1">@yield('subtitle', __('layout.app_subtitle'))</h1>
            @hasSection('description')
                <p class="mb-0">@yield('description')</p>
            @endif
        </div>
    </header>

    <main class="container my-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="copyright py-4 text-center bg-secondary text-white mt-auto">
        <div class="container">
            <small>{{ __('layout.footer_user') }}</small>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"
    ></script>

    @stack('scripts')
</body>
</html>