@extends('landing.master')

@section('content')

<div class="row pt-5">

    <!-- Main Content -->
    <div class="col-md-8">


        <div class="justify-content-between my-4">
            <h1 class="">Sugestões</h1>
            <h5>Sugestões que estão associadas a categoria {{ $category->name }}</h5>

            <div class="my-4 mb-0">
                {{-- {{ $suggests->links() }} --}}
            </div>
        </div>
{{--
        @foreach ($suggests as $s)

            @include('landing.components.suggest')

        @endforeach

        {{ $suggests->links() }} --}}

    </div>

    <!-- Sidebar-->
    <div class="col-md-4">
        @include('landing.parts.sidebar.sidebar')
    </div>

</div>

@endsection
