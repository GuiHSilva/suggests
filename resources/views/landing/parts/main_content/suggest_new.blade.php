@section('custom_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet" >
@endsection

<h1 class="my-4">Nova sugestão...
</h1>

<div class="card mb-4 ">
    <div class="card-body">


        <!-- tips of the suggests -->
        <div class="card">
            <div class="card-body">
                <p class="card-text">

                    <strong>Dicas:</strong>

                    <p class="mb-0">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit numquam aliquam consectetur, culpa sequi sit dolorum id, ullam quia perferendis, quasi exercitationem molestias delectus recusandae blanditiis suscipit possimus sunt beatae.
                    </p>

                    <p class="mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur porro odit architecto quis corrupti modi! Fugiat, at nobis necessitatibus id ducimus ut fuga repudiandae nisi libero quisquam quo obcaecati consectetur.
                    </p>

                </p>
            </div>
        </div>

        <div class="row">

            <div class=" col-12 pt-2">

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        A sua sugestão possui alguns erros:
                        <ul>
                            @foreach (Session::get('error')->messages() as $msg)
                                <li>
                                    {{ $msg[0] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @csrf

                <div class="form-group">
                    <label for="title">Título da sua sugestão</label>
                    <input type="text" id="title" name="title" class="form-control" aria-describedby="helpId" required>
                    <small class="text-muted">Dê um título significativo para a sua sugestão.</small>
                </div>

                <div class="form-group">
                    <label for="category">Categorias da sugestão</label>

                    <select class="form-control" id="categories" name="categories[]" multiple="multiple">
                    </select>

                    <small id="helpId" class="text-muted">Ecolha <strong>até 3 categorias</strong> que estejam relacionadas a sua sugestão.</small>
                </div>

                @guest
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1">Sua sugestão será anonima?</label>
                        </div>
                    </div>
                @endguest

                <div class="form-group">
                    <label for="category">Sua sugestão</label>
                    <div id="content" name="content"></div>
                    <small>Expresse tudo que passa pela sua cabeça.</small>
                </div>

                @if(env('GOOGLE_RECAPTCHA_KEY'))
                    <div class="mb-3 text-right">
                        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                    </div>
                @else
                    <div class="text-danger">O reCaptcha nao foi configurado corretamente, notifique um administrador do site.</div>
                @endif

                <div class="form-group">

                    <button class="btn btn-primary" id="sendBtn">Enviar sugestão!</button>

                </div>

            </div>

        </div>

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
                    _token:                 $('input[name="csrfToken"]').attr('value'),
                    title:                  $('#title').val(),
                    categories:             $('#categories').select2('data'),
                    content:                $('#content').summernote('code'),
                    anonymous_suggest:      ($('#customSwitch1') ? $('customSwitch1').checked : false),
                    g_recaptcha_response:   grecaptcha.getResponse()
                }

                $.ajax({
                    data: JSON.stringify(content),
                    type: 'POST',
                    processData: false,
                    contentType: 'application/json',
                    url: "/sugestao/store",
                    success: function (response) {

                    }
                });

            });

        });
    </script>

    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endsection
