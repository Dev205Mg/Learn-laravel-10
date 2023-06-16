<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function create()
    {
        $post = new Post();
        $post->title = "Votre titre";
        $post->slug = "";
        $post->content = "Votre contenue";
        return view('post.create', [
            'post'=> $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function store(FormPostRequest $request){

        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug'=> $post->slug, 'post' => $post->id])->with('success', "L'article à été bien sauvegargée");
    }

    public function index(): View
    {
        $posts = Post::with('tags', 'category')->paginate(10);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function show(string $slug,Post $post) : RedirectResponse | View
    {
        if($post->slug !== $slug){
            return to_route('blog.show',[
                'slug' => $post->slug,
                'id' => $post->id
            ]);
        }
        return view('post.show', [
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get()
        ]);
    }

    public function update( Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug'=> $post->slug, 'post' => $post->id])->with('success', "L'article à été bien modifiée");
    }
}
