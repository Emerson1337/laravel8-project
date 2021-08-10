<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect()->route('posts.index')->with('message', 'Post criado com sucesso!');
    }

    public function show(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if ($post) {
            return view('admin.posts.show', compact('post'));
        } else {
            return view('admin.posts.index')->with('errors', 'Este post não existe!');
        };
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('errors', 'Post não encontrado');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        return view('admin.posts.create', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }
        $post->update($request->all());
        return redirect()->route('posts.index')->with('message', 'Post editado com sucesso!');
    }
}
