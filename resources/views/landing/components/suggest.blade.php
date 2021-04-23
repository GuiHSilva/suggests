
<div class="card mb-4 ">
    <div class="card-body">
        <h4 class="card-title mb-0">{{ $s->title }}</h4>
        <p class="text-muted">{!! $s->getCategoriesWithCommas() !!}</p>
        <p class="card-text">
            <div class="collapse multi-collapse-{{ $s->slug }}" id="collapseSuggestRaw{{ $s->slug }}">
                {!! $s->content !!}
            </div>
            <div class="collapse show multi-collapse-{{ $s->slug }}" id="collapseSuggestMin{{ $s->slug }}">
                {!! $s->getResumedContent() !!}
            </div>
        </p>
    </div>
    <div class="card-footer text-muted justify-content-between d-flex align-items-center">
        <div>
            {{ $s->getTimeAgoPost() }}
            •
            @if ($s->user)
                <a href="#!">{{ $s->user->name }}</a>
            @else
                Enviado anonimamente
            @endif
        </div>

        <div>
            <span>
                <span id="curtidas-{{ $s->id }}">{{ $s->likes }} curtidas</span>
                <a href="#!" class="btn btn-sm {{ $s->liked() }} like-sugestao" sugestao="{{ $s->id }}"
                    data-toggle="tooltip" data-placement="top" title="Clique para curtir">
                    <i class="fas fa-heart"></i>
                </a>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Mostrar/recolher sugestão completa">
                <a href="#!"
                    class="btn btn-sm btn-outline-primary"
                    data-toggle="collapse"
                    data-target=".multi-collapse-{{ $s->slug }}"
                    aria-expanded="false"
                    aria-controls="collapseSuggestMin{{ $s->slug }} collapseSuggestRaw{{ $s->slug }}"
                >
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </a>
            </span>
        </div>
    </div>
</div>


@section('custom_js')

<script>

    // Animacao do botao de collapse
    $(document).on('click', '[data-toggle="collapse"]', function  () {
        $("i", this).toggleClass("fa-arrow-down fa-arrow-up");
    })

    // Habilitar o tooltip
    $('[data-toggle="tooltip"]').tooltip()

</script>

@endsection
