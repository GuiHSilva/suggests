<div class="card my-4">
    <h5 class="card-header">Categorias</h5>
    <div class="card-body">
        @foreach ($categories as $cat)
        <a href="{{ route('home.categoria.show', $cat->id) }}">{{ $cat->name }}</a>
        @endforeach
    </div>
    <div class="card-footer">
        <a class="btn btn-sm btn-primary" href="{{ route('home.categoria') }}" role="button">Ver todos</a>
    </div>
</div>
