
@guest
<!-- Modal -->
<div class="modal fade" id="modalEscolha" tabindex="-1" aria-labelledby="modalEscolha" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Escolha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0 align-self-end">
                    <p>
                        Ao fazer uma sugestão idenficada somente o seu nome aparecerá vinculado à sugestão. Somente os administradores poderão ver seus dados para contato. <strong>(RECOMENDADO)</strong>
                    </p>
                    <a href="{{ route('register') }}" type="button" class="btn btn-primary btn-lg btn-block">Sugestão identificada</a>
                </div>

                <div class="col-lg-6 col-md-12 mb-4 mb-md-0 align-self-end">
                    <p>
                        Sugestões anonimas não são identificadas de nenhuma maneira. Você apenas escreve, e envia!
                    </p>
                    <a href="{{ route('sugestao.nova') }}" type="button" class="btn btn-primary btn-lg btn-block">Sugestão anônima</a>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
</div>
@endguest
