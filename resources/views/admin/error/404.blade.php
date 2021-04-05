@extends('adminlte::page')

@section('title', 'Suggests')

@section('content_header')
    <h1 class="m-0 text-dark">Página não encontrada</h1>
@stop

@section('content')

    <section class="content">
        <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página nao encontrada.</h3>

            <p>
            Não encontramos a página que você está procurando. Talvez ela tenha sido movida de lugar ou nunca existiu!
            Você pode ir até a <a href="{{ route('admin') }}">pagina inicial</a> ou tente fazer uma busca.
            </p>

            <form class="search-form" action="{{ route('admin.pesquisa') }}" method="POST">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Procurar">

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            <!-- /.input-group -->
            </form>
        </div>
        <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
@stop
