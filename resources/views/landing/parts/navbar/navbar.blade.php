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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('home.usuario', Auth::user()->id) }}" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>

                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="{{ route('home.usuario', Auth::user()->id) }}">
                                <i class="fas fa-user"></i>
                                Minha conta
                            </a>
                            <a class="dropdown-item" href="{{ route('admin') }}">
                                <i class="fas fa-cog"></i>
                                Painel administrador
                            </a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                <i class="fas fa-door-open    "></i>
                                Sair
                            </a>
                        </div>

                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
