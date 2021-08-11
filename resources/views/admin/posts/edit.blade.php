@extends('admin.layouts.app')

@section('title', 'Edição')

@section('content')
<h1 class="text-center text-3xl uppercase font-black my-4">Editar o Post <strong>{{$post->title}}</strong></h1>
<div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12 mx-auto">
    <form action="{{route('posts.update', ['id' => $post->id])}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.posts._partials.form')
    </form>
</div>

@endsection
