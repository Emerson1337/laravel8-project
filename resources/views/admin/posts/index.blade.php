@extends('admin.layouts.app')

@section('title', 'Listagem')

@section('content')
<a href="{{route('posts.create')}}">Cadastrar</a>
<hr>
@if(session('message'))
<div>
    {{ session('message') }}
</div>
@endif

<form action="{{route('posts.search')}}" method="post">
    @csrf
    <input type="text" name="search" placeholder="Filtrar">
    <button type="submit">Filtrar</button>
</form>

<h1>Posts</h1>
@if(isset($posts))
@foreach($posts as $post)
<img src='{{url("storage/{$post->image}")}}' width="100px">
<p>
    <strong>
        Título:
    </strong>{{$post->title}} [ <a href="{{route('posts.show', ['id' => $post->id])}}">Ver</a> ]
    [ <a href="{{route('posts.edit', ['id' => $post->id])}}">Editar</a> ]
</p>
@endforeach
@endif

<hr>

@if(isset($filters))
{{$posts->appends($filters)->links()}}
@else
{{$posts->links()}}
@endif
@endsection
