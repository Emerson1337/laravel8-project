<a href="{{route('posts.create')}}">Cadastrar</a>
<hr>
<h1>Posts</h1>

@foreach($posts as $post)
<p>{{$post->title}}</p>
<p>{{$post->content }}</p>
@endforeach
