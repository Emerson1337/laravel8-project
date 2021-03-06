<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'ASC')->paginate(1);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {

            $nameFile = Str::of($request->title)
                ->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        Post::create($data);
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

        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        };

        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {

            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            };

            $nameFile = Str::of($request->title)
                ->slug('-') . '.' . $request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        $post->update($data);
        return redirect()->route('posts.index')->with('message', 'Post editado com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', '=', "%$request->search%")
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate(1);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
