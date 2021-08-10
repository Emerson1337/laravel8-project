<a href="{{route('posts.create')}}">Cadastrar</a>
<hr>
@if(session('message'))
<div>
    {{ session('message') }}
</div>
@endif

<h1>Posts</h1>
@if(isset($posts))
@foreach($posts as $post)
<p><strong>
        Título: </strong>{{$post->title}} [ <a href="{{route('posts.show', ['id' => $post->id])}}">Ver</a> ]
    [ <a href="{{route('posts.edit', ['id' => $post->id])}}">Editar</a> ]
</p>
<p><strong>Descrição: </strong>{{$post->content }} </p>
@endforeach
@endif
