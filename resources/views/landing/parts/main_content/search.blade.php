@extends('landing.master')

@section('content')

<div class="row pt-5">

    <!-- Main Content -->
    <div class="col-md-8">


        <div class="d-flex justify-content-between my-4">
            <h1 class="">Buscando por: <i>{{ $q }}</i>
            </h1>
            <div class="my-4 mb-0">
                {{ $suggests->links() }}
            </div>
        </div>

        @foreach ($suggests as $s)

            @include('landing.components.suggest')

        @endforeach

        {{ $suggests->links() }}

    </div>

    <!-- Sidebar-->
    <div class="col-md-4">
        @include('landing.parts.sidebar.sidebar')
    </div>

</div>

@endsection
