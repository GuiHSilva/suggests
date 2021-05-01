@extends('adminlte::page')

@section('title', 'Suggests')

@section('content_header')
<h1 class="m-0 text-dark">Sugestão</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-3">

        <!-- Usuario -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">

                @if ($user)
                    @include('vendor/adminlte/partials/suggest/profile')
                @else
                    @include('vendor/adminlte/partials/suggest/profile-anonymous')
                @endif

                <a href="{{ route('admin.usuario.show', $user->id) }}" class="btn btn-primary btn-block"><b>Ver usuário</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Categorias -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Categorias</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('vendor.adminlte.partials.suggest.categories')

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->


    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $suggest->title }}</h4>
            </div>
            <div class="card-body">
                <div>
                    {!! $suggest->content !!}
                </div>
            </div>
        </div>
    </div>


</div>
@stop

@section('adminlte_js')

<script>
    $(function () {

        var current_page = 1;

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            current_page = page;
            fetch_data(page);
        });

        $(document).on('click', '.botoes-acao .mark-read a', function (e) {
            e.preventDefault();

            var page = $(this).attr('sugestao')
            markRead(page)
        });

        function markRead(data) {

            $.ajax({
                type: "GET",
                url: "sugestao/" + data + "/mark-read",
                success: function (response) {

                    if (response.error) {
                        toastr.error(response.msg, 'Ops!')
                    } else {
                        toastr.success(response.msg, 'Sucesso!')
                    }

                    fetch_data(current_page);

                },
                error: function (response) {

                    toastr.error('Não foi possível atualizar a sugestões: ' + response.status,
                        'Ops!')

                }
            });
        }

        function fetch_data(data) {

            $.ajax({
                type: "GET",
                url: "sugestao/pagination?page=" + data,
                success: function (response) {

                    $('#tabela-sugestoes').html(response);

                },
                error: function (response) {

                    toastr.error('Não foi possível atualizar a lista de sugestões: ' + response
                        .status, 'Ops!')

                }
            });

        }

    });

</script>

@endsection
