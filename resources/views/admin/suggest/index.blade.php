@extends('adminlte::page')

@section('title', 'Suggests')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de sugestões</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div id="tabela-sugestoes">

                        @include('admin/suggest/table')

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

        $(document).on('click', '.mais-recente-btn a', function (e) {
            alert(1)
            e.preventDefault()
            $(this).addClass('active');
        });

        function markRead(data) {

            $.ajax({
                type: "GET",
                url: "sugestao/" + data + "/mark-read",
                success: function (response) {

                    if (response.error) {
                        toastr.error(response.msg , 'Ops!')
                    } else {
                        toastr.success(response.msg , 'Sucesso!')
                    }

                    fetch_data(current_page);

                }, error: function (response) {

                    toastr.error('Não foi possível atualizar a sugestões: ' + response.status , 'Ops!')

                }
            });
        }

        function fetch_data(data) {

            $.ajax({
                type: "GET",
                url: "sugestao/pagination?page=" + data,
                success: function (response) {

                    $('#tabela-sugestoes').html(response);

                }, error: function (response) {

                    toastr.error('Não foi possível atualizar a lista de sugestões: ' + response.status , 'Ops!')

                }
            });

        }



    });

</script>

@endsection
