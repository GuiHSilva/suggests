<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">@yield('title', config('adminlte.title', 'AdminLTE 3'))</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrar-se</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.usuario', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-door-open"></i>
                                Sair
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
