
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
        <form action="{{ route('search') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control {{ $errors->has('q') ? 'is-invalid' : '' }}"
                    value="{{ old('q') }}" name="q" placeholder="Procurar por...">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                </span>
            </div>
            @if ($errors->has('q'))

                <div class="text-danger">
                    {{ $errors->first('q') }}
                </div>

            @else
            <small>Procure por sugestões, use palavras chaves presentes no conteúdo e título da sugestão
            </small>
            @endif
        </form>
    </div>
</div>

<!-- Categories Widget -->
<x-categories-widget/>

<!-- Side Widget -->
<x-suggest-info-widget/>

@section('modals')
    @include('landing.parts.modal.suggest_type')
@endsection
