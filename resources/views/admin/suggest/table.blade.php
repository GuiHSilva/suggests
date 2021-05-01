


<div class="row d-flex justify-content-between mx-3">
    <div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
            <div class="dropdown-menu" aria-labelledby="triggerId">
                <h6 class="dropdown-header">Ordenação</h6>
                <a class="dropdown-item mais-antigo-btn" href="#">Mais antigo</a>
                <a class="dropdown-item mais-recente-btn" href="#">Mais recente</a>
                <a class="dropdown-item mais-curtidas" href="#">Mais curtidas</a>
                <h6 class="dropdown-header">Filtro</h6>
                <a class="dropdown-item nao-lidas-btn" href="#">Não lidas</a>
                <a class="dropdown-item lidas-btn" href="#">Lidas</a>
                <a class="dropdown-item excluidas-btn" href="#">Excluídas</a>
            </div>
        </div>
    </div>
    <div>
        <div class="justify-content-end">
            {{ $suggests->links() }}
        </div>
    </div>
</div>

@foreach ($suggests as $suggest)

<div class="card mt-2 ml-3 mr-3 mb-0 {{ $suggest->getCardCssNotViewd() }}">

    <div class="card-header">
        <div class="row d-flex justify-content-between">
            <div>
                <a href="{{ route('admin.sugestao.show', $suggest->id) }}">{{ $suggest->title }}</a>
            </div>
            <div class="text-danger">

                @if (!$suggest->public)
                    <span data-toggle="tooltip" data-placement="top" title="Essa sugestão não é pública para receber curtidas!" class="badge badge-warning">PRIVADO</span>
                @else
                    <div data-toggle="tooltip" data-placement="top" title="Essa sugestão possui {{ $suggest->likes }} curtidas">
                        {{ $suggest->likes }} <i class="fas fa-heart"></i>
                    </div>
                @endif</span>

            </div>
        </div>
    </div>

    <div class="card-body" href="{{ 'sugestao/' . $suggest->id }}">
        {{ $suggest->getContentWithoutHtml() }}
        <div class="text-muted mb-0">
            Autor {{ $suggest->authorName() }} enviado em {{ date('d/m/Y h:i', strtotime($suggest->created_at)) }}
        </div>
    </div>

    <div class="card-footer">

        <!-- FOOTER DO CARD -->
        <div class="d-flex justify-content-between align-items-center">

            <!-- CATEGORIAS NO FOOTER -->
            <div class="text-muted">

                @if (count($suggest->categories) > 0)
                    <span>
                    @foreach ($suggest->categories as $cat)
                        <span class="badge badge-secondary aligm-items-center">{{ $cat->name }}</span>
                    @endforeach
                    </span>
                @else
                    Nenhuma categoria associada
                @endif

            </div>

            <!-- BOTOES DO FOOTER -->
            <div class="botoes-acao d-flex justify-content-end">

                <div>
                    <a type="button" class="btn btn-sm btn-primary ml-2" title="Abrir" href="{{ route('admin.sugestao.show', $suggest->id) }}">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
                <div>
                    <a type="button" class="btn btn-sm btn-danger ml-2" title="Excluír" href="#">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                @if ($suggest->viewed)
                <div>
                    <a type="button" class="btn btn-sm btn-info ml-2 mark-read" sugestao="{{ $suggest->id}}" title="Marcar como não lida" href="#">
                        <i class="fas fa-asterisk"></i>
                    </a>
                </div>
                @endif

            </div>

        </div>

    </div>
</div>

@endforeach

<div class="row justify-content-end mr-3 mt-4">
    {{ $suggests->links() }}
</div>

@section('adminlte_js')
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
