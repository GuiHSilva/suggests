@extends('landing.master')

@section('content')

<div class="row pt-5">

    <!-- Main Content -->
    <div class="col-md-8">

        <div class="d-flex justify-content-between my-4">
            <h1 class=""> Sugestão </h1>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">{{ $suggest->title }}</h4>

                <div>
                    @if ($suggest->public)
                        {{ $suggest->likes }} curtidas
                        {!! $suggest->likeButton() !!}
                    @else
                        <span class="badge badge-danger">PRIVADO</span>
                    @endif
                </div>
            </div>


            <div class="card-body">
                <div class="d-flex justify-content-between">

                    <p class="card-text mb-0">{!! $suggest->getCategoriesWithCommas() !!}</p>
                    <p class="card-text mb-0">
                        @if ( $suggest->user )
                            <a href="{{ route('home.usuario', $suggest->user->id) }}">{{ $suggest->user->name }}</a>
                        @else
                            Enviado anonimamente
                        @endif
                    </p>

                </div>

                <hr>

                <div class="mt-2">
                    {!! $suggest->content !!}
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">
                Publicado {{ strftime('%A, %d de %B de %Y', strtotime($suggest->created_at)) }} ás {{ date('H:i', strtotime($suggest->created_at)) }}
            </div>

        </div>

        <div>

            @if (!$suggest->public)
            <div class="card-footer text-muted">
                <small>
                    Esta sugestão é privada. Isto quer dizer que ela não aparecerá na lista de sugestões para que todos vejam, somente pessoas que possuam este link vão conseguir vê-la. Pode ser enviada anonimamente ou não. Sugestões privadas não recebem curtidas.
                </small>
            </div>
            @endif

        </div>

    </div>

    <!-- Sidebar-->
    <div class="col-md-4">
        @include('landing.parts.sidebar.sidebar')
    </div>

</div>

@endsection
