@extends('admin.layouts.app')

@section('title', 'Edição')

@section('content')
<h1>Editar o Post <strong>{{$post->title}}</strong></h1>

<form action="{{route('posts.update', ['id' => $post->id])}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.posts._partials.form')
    <button type="submit">Editar</button>
</form>

@endsection
