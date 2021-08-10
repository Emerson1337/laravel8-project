@if(isset($post))
<h1>Editar Post</h1>
@else
<h1>Cadastrar Novo Post</h1>
@endif

@if($errors->any())
<div>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@endif
@if(isset($post))
<form action="{{route('posts.update', ['id' => $post->id])}}" method="post">
    @method('PUT')
    @else
    <form action="{{route('posts.store')}}" method="post">
        @endif
        @csrf
        <input type="text" name="title" id="title" placeholder="Título..." value="{{ isset($post) ? $post->titulo : old('title')}} ">
        <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteúdo...">{{isset($post) ? $post->content : old('content')}}</textarea>
        <button type="submit">
            @if(isset($post))
            Editar
            @else
            Enviar
            @endif
        </button>
    </form>
