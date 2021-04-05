<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Envie sugestões anonimamente ou não de forma construtíva">
    <meta name="author" content="Guilherme Henrique da Silva">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    @yield('meta_tags')

    <!-- Bootstrap core CSS and Fontawsome -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.css') }}" rel="stylesheet">

    <!-- Custom styles -->
    @yield('custom_css')

</head>

<body>

    @include('landing.parts.navbar.navbar')

    <!-- Page Content -->
    <div class="container">

        @yield('content')

    </div>
    <!-- /.container -->

    <!-- Modais -->
    @yield('modals')
    <!-- /. Modais -->

    @include('landing.parts.footer.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    @yield('custom_js')

</body>

</html>
