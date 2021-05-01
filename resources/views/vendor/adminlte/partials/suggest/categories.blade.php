@if (sizeof($suggest->categories) > 0)

    @foreach ($suggest->categories as $cat)
        <strong>
            <a href="{{ route('admin.categoria', $cat->id) }}">
                {{$cat->name}}  <i class="fas fa-external-link-alt"></i>
            </a>
        </strong>

        <p class="text-muted">
            {{ $cat->description }}
        </p>
    @endforeach

@else

    <div class="text-center text-muted">
        Esta sugestão não foi associada à nenhuma categoria.
    </div>

@endif
