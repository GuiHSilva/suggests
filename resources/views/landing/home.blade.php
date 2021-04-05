@extends('landing.master')

@section('content')

<div class="row pt-5">

    <!-- Main Content -->
    <div class="col-md-8">
        @include('landing.parts.main_content.main_content')
    </div>

    <!-- Sidebar-->
    <div class="col-md-4">
        @include('landing.parts.sidebar.sidebar')
    </div>

</div>

@endsection
