<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MusicDesk</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-yEPZ7jP9S0QKiUQ0m3jjsO4ProIW7wvR9gXkI7JOGa2XVsw53Yke2bsdkBbjmmiX"
        crossorigin="anonymous">

    {{-- CSS próprio --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('welcome') }}">
                MusicDesk
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.home') }}">
                                BackOffice
                            </a>
                        </li>
                    @endauth

                </ul>

                @if (Route::has('login'))
                    <nav class="d-flex align-items-center gap-2">

                        @auth
                            <span class="me-2">
                                Olá, {{ Auth::user()->name }}
                            </span>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    Logout
                                </button>
                            </form>

                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                Login
                            </a>

                            @if (Route::has('users.add'))
                                <a href="{{ route('users.add') }}" class="btn btn-primary">
                                    Registar
                                </a>
                            @endif

                        @endauth

                    </nav>
                @endif

            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-WyOxWvTyr1QaMPfiPJSv76iReVthorl5uWlFtZPyK0IE0hGzo9y5Bp9mYanr8Bu"
        crossorigin="anonymous">
    </script>

</body>
</html>
