@extends('landing.master')

@section('content')

<div class="row pt-5">

    <!-- Main Content -->
    <div class="col-md-12">


        @section('custom_css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet" >
        @endsection

        <h1 class="my-4">Dar uma sugestão
        </h1>

        <div class="card mb-4 ">
            <div class="card-body">

                <!-- tips of the suggests -->
                <div class="accordion" id="accordionTips">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Dicas para a sua sugestão
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionTips">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga sed quia explicabo cumque vitae ut maxime sequi! Aliquam quo aut voluptate, dicta rem dolore assumenda laudantium id? Et, iure nisi.
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('sugestao.store') }}" method="post">

                    <div class="row">

                        <div class="col-12 pt-2">

                            @csrf

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Fechar</span>
                                    </button>
                                    <strong>Sucesso!</strong> A sua sugestão "{{ Session::get('suggest')->title }}" foi registrada com sucesso!
                                    <a href="{{ route('sugestao.show', Session::get('suggest')->slug) }}">Clique aqui</a> para ver a sugestão.

                                </div>
                            @endif

                            <div class="form-group">
                                <label for="title">Título da sua sugestão</label>
                                <input type="text" id="title" name="title"
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    aria-describedby="helpId"
                                    required
                                    value="{{ old('title') }}">
                                @if($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @else
                                    <small class="text-muted">Dê um título significativo para a sua sugestão.</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="category">Categorias da sugestão</label>

                                <select class="form-control" id="categories" name="categories[]" multiple="multiple">
                                    @if (is_array(old('categories')))
                                        @foreach (old('categories') as $tag)
                                            <option value="{{ $tag }}" selected="selected">
                                                {{ App\Models\Category::where('id', $tag)->value('name') }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="helpId" class="text-muted">Escolha <strong>até 3 categorias</strong> que estejam relacionadas a sua sugestão.</small>
                            </div>

                            <div class="form-group">
                                <label for="category">Sua sugestão</label>
                                <textarea id="content" name="content"
                                    class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                    >{{ old('content') }}</textarea>
                                @if($errors->has('content'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </div>
                                @else
                                    <small class="text-muted">Expresse tudo que passa pela sua cabeça.</small>
                                @endif
                            </div>

                            @if(env('GOOGLE_RECAPTCHA_KEY'))

                                <div class="text-right">
                                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                </div>
                                @if($errors->has('g-recaptcha-response'))
                                    <div class="text-danger">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </div>
                                @endif

                            @else
                                <div class="text-danger">O reCaptcha nao foi configurado corretamente, notifique um administrador do site.</div>
                            @endif


                            <div class="mt-3 form-group d-flex align-items-center">

                                <div>
                                    <button type="submit" class="btn btn-primary">Enviar sugestão!</button>
                                </div>

                                @guest
                                <div class="text-danger ml-sm-1 ml-md-4 ml-lg-4">
                                    <strong>AVISO: </strong>Você está enviando uma sugestão anônima!
                                </div>
                                @endguest

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        @section('custom_js')
        <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>

            <!-- SELECT2 -->
            <script>
                $(function () {
                    $('#categories').select2({
                        maximumSelectionSize: 3,
                        theme: "bootstrap",
                        tokenSeparators: [','],
                        tags: true,
                        templateResult: formatState,
                        ajax: {
                            url: '/api/categories',
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return { results: $.map(data, function (item) {
                                                    return {
                                                        text: item.name,
                                                        description: item.description,
                                                        id: item.id
                                                    }
                                                })
                                        };
                            },
                        }
                    });
                    function formatState (state) {
                        if (!state.id) {
                            return null;
                        }
                        var baseUrl = "/user/pages/images/flags";
                        var $state = $(
                            '<div><h5 class="mb-0">' + state.text + '</h5><small>' + state.description + '</small></div>'
                        );
                        return $state;
                    };

                });
            </script>

            <script src="{{ asset('vendor/summernote/summernote-lite.min.js') }}"></script>

            <!-- Summernote -->
            <script>
                var textarea = $('#content').summernote({
                    placeholder: 'Escreva aqui a sua sugestão',
                    minHeight: null,
                    maxHeight: null,
                    tabsize: 2,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']]
                    ],
                    lang: 'pt-BR'
                });
            </script>

            <!-- Custom JS -->
            <script>
                $(function () {

                    $(document).on('click', '#sendBtn', function (e) {
                        e.preventDefault();

                        var content = {
                            _token:                 $('meta[name="csrf-token"]').attr('content'),
                            title:                  $('#title').val(),
                            categories:             $('#categories').select2('data'),
                            content:                $('#content').summernote('code'),
                            anonymous_suggest:      ($('#anonymous_btn')[0] ? $('#anonymous_btn')[0].checked : false),
                            g_recaptcha_response:   grecaptcha.getResponse()
                        }

                        $.ajax({
                            data: JSON.stringify(content),
                            type: 'POST',
                            processData: false,
                            contentType: 'application/json',
                            url: "/sugestao/store",
                            success: function (response) {

                                if (response.error ) {

                                    var msg = '';
                                    console.log(response.msg);
                                    response.msg.forEach(element => {
                                        console.log(element);
                                    });


                                }

                            }, error: function (response) {

                                alert(2);
                                $('#lista-erros').html(response.msg);
                            }
                        });

                    });

                });
            </script>

            <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        @endsection


    </div>

</div>

@endsection
