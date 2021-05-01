@extends('adminlte::page')

@section('title', 'Suggests')

@section('content_header')
    <h1 class="m-0 text-dark">Lista de categorias</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    TODO this page

                    <table class="table table-striped table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Disponível</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')

<script>

    $(function () {

        $('.table').DataTable({

        });

    });

</script>

@endsection
