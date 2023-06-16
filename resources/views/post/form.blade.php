<form action="" method="post" class="vstack gap-2">
    @csrf
    <div class="form-group">
        <label for="title" class="form-label">Titre</label>
        <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        @error('title')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug" class="form-label">Slug</label>
        <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" id="content" > {{ old('content', $post->content) }}</textarea>
        @error('content')
            {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="category" class="form-label">Catégorie</label>
        <select class="form-select" name="category_id" id="category" >
            <option value="">Séléctionner une catégorie </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            {{ $message }}
        @enderror
    </div>
    @php
        $tagsIds = $post->tags()->pluck('id');
    @endphp
    <div class="form-group">
        <label for="tag" class="form-label">Tags</label>
        <select class="form-select" name="tags[]" id="tag" multiple>
            @foreach ($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}" >{{ $tag->name }}</option>
            @endforeach
        </select>
        @error('tags')
            {{ $message }}
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        @if ($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
