<div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="{{ asset('vendor/adminlte/dist/img/anonymous_user.png') }}">
</div>

<h3 class="profile-username text-center">Não identificado!</h3>

<p class="text-muted text-center">A pessoa que fez essa sugestão preferiu não se identificar</p>

<ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
        <b>Data </b> <a class="float-right">{{ $suggest->created_at->format('d/m/y H:i') }}</a>
    </li>
</ul>
