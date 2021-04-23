
<div class="my-4 d-flex justify-content-between">
    <h1 class="">Últimas sugestões
    </h1>
    <div class="mb-0">
        {{ $suggests->links() }}
    </div>
</div>

@foreach ($suggests as $s)

    @include('landing.components.suggest')

@endforeach

{{ $suggests->links() }}

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

    })
</script>
@endsection
