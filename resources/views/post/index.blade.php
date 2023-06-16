@extends('base')

@section('title', 'Accueil du blog')

@section('content')
    <h1>Mes blogs</h1>

    @foreach ($posts as $post )
        <article>
            <h2>{{ $post->title }}</h2>

            <p class="small">
                @if ($post->category)
                    Catégorie : <strong>{{ $post->category?->name }}</strong>
                @endif

                @if (!$post->tags->isEmpty())
                    | Tags :
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                @endif
            </p>

            <p>
                {{ $post->content }}
            </p>
            <p>
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Lire la suite</a>
                <a href="{{ route('blog.edit', ['post' => $post]) }}" class="btn btn-secondary">Editer</a>
            </p>
        </article>
    @endforeach

    {{ $posts->links() }}
@endsection
