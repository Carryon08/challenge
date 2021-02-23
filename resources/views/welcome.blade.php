<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libreria</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <nav class="navbar navbar-expand-md navbar-light sticky-top" style="background-color: cyan">
            <a class="navbar-brand" href="#">Devux</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="collapsibleNavbar">
                <ul class="navbar-nav float-right ml-auto">
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                        @if (Route::has('login'))
                        <div class="hidden fixed sm:block">
                            @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        Perfil
                                    </a>
                                </div>
                            </li>
                            @else
                            <a class="nav-link"
                               style="cursor: pointer; color: black"
                               data-toggle="modal"
                               data-target="#loginModal">{{ __('Login') }}</a>

<!--                            @if (Route::has('register'))-->
<!--                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>-->
<!--                            @endif-->
                            @endauth
                        </div>
                        @endif
                    </div>
                </ul>
            </div>
        </nav>
        <br>

    </head>
    <body class="">
        <div id="app" class=" ">
            <h1 class="align-content-center" align="center" >Challenge</h1>
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-3 bg-white m-5" style="border-radius: 5px; " >
                        <img class="card-img-top m-1" src="../img/background.jpg" alt="Card image cap">
                            <h5 class="card-title p-3" align="center">Imagen 1</h5>
                    </div>
                    <div class="col-3 bg-white m-5" style="border-radius: 5px; ">
                        <img class="card-img-top m-1" src="../img/desck.jpg" alt="Card image cap">
                        <h5 class="card-title p-3" align="center">Imagen 2</h5>
                    </div>
                    <div class="col-3 bg-white m-5" style="border-radius: 5px; " >
                        <img class="card-img-top m-1" src="../img/background.jpg" alt="Card image cap">
                        <h5 class="card-title p-3" align="center">Imagen 3</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="container"></div>
        @include('partials.login')
    </body>
</html>
<script>
</script>
<style>
    body {
        background-image: url('../img/laptop.jpg');
    }
    h1{
        font-family: sans-serif;
        margin: auto auto;
        color: cyan;
        font-weight: 100;
        font-size: 8vw;
    }
    p {
        color: white;
    }
</style>
