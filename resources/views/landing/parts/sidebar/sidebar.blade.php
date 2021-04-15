
<h1 class="my-4">Informações
</h1>



<div class="card my-4">
    <div class="card-body">
        <a class="btn btn-success btn-lg" role="button" style="width: 100%;"

        @guest
            data-toggle="modal" data-target="#modalEscolha"
        @endguest

        @auth
            href="{{ route('sugestao.nova') }}"
        @endauth

        >Dar uma sugestão ⭐</a>
    </div>
</div>



<div class="card my-4">
    <h5 class="card-header">Procurar</h5>
    <div class="card-body">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Procurar por...">
            <span class="input-group-append">
                <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
            </span>
        </div>
        <small>Procure por sugestões, use palavras chaves presentes no conteúdo da sugestão
        </small>
    </div>
</div>



<!-- Categories Widget -->
<div class="card my-4">
    <h5 class="card-header">Categorias</h5>
    <div class="card-body">
        <a href="#!">Teste</a>
        <a href="#!">Teste</a>
        <a href="#!">Teste</a>
        <a href="#!">Teste</a>
    </div>
    <div class="card-footer">
        <a class="btn btn-sm btn-primary" href="#" role="button">Ver todos</a>
    </div>
</div>



<!-- Side Widget -->
<div class="card my-4">
    <h5 class="card-header">Estatísticas</h5>
    <div class="card-body">

        <p class="mb-0">
            São <strong>x</strong> sugestões enviadas.
        </p>
        <p class="mb-0">
            Sendo <strong>x</strong> com identificaçao.
        </p>
        <p class="mb-0">
            Há <strong>x</strong> categorias disponíveis.
        </p>
        <p class="mb-0">
            Existem <strong>x</strong> usuários cadastrados.
        </p>

    </div>
</div>

@section('modals')
    @include('landing.parts.modal.suggest_type')
@endsection
