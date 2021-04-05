<div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="{{ 'https://www.gravatar.com/avatar/' . md5(trim($user->email)) }}">
</div>

<h3 class="profile-username text-center">{{ $user->name }}</h3>

<p class="text-muted text-center">{{ $user->email }}</p>

<ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
        <b>Sugestões</b> <a class="float-right">{{ $user->suggestAmount() }}</a>
    </li>
    <li class="list-group-item">
        <b>Data </b> <a class="float-right">{{ $suggest->created_at->format('d/m/y H:i') }}</a>
    </li>
</ul>
