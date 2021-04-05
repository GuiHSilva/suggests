
<h1 class="my-4">Últimas sugestões
</h1>

@foreach ($suggests as $s)

<div class="card mb-4 ">
    <div class="card-body">
        <h4 class="card-title mb-0">{{ $s->title }}</h4>
        <p class="text-muted">{{ $s->getCategoriesWithCommas() }}</p>
        <p class="card-text">
            <div class="collapse multi-collapse-{{ $s->id }}" id="collapseSuggestRaw{{ $s->id }}">
                {{ $s->content }}
            </div>
            <div class="collapse show multi-collapse-{{ $s->id }}" id="collapseSuggestMin{{ $s->id }}">
                {{ $s->getResumedContent() }}
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
                    data-target=".multi-collapse-{{ $s->id }}"
                    aria-expanded="false"
                    aria-controls="collapseSuggestMin{{ $s->id }} collapseSuggestRaw{{ $s->id }}"
                >
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </a>
            </span>
        </div>
    </div>
</div>

@csrf
@endforeach


@section('custom_js')
<script>
    $(function () {

        $(document).on('click', '.like-sugestao', function (e) {
            e.preventDefault()
            $(this).toggleClass("btn-outline-danger btn-danger");

            $.ajax({
                type: "POST",
                url: "sugestao/" + $(this).attr('sugestao') + "/like",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                }, error: function (response) {
                    console.log(response);
                }
            });
        })

        $(document).on('click', '[data-toggle="collapse"]', function  () {
            $("i", this).toggleClass("fa-arrow-down fa-arrow-up");
        })

        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
