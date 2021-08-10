<h1>Detalhes do post: {{$post->id}}</h1>
<ul>
    <li>{{$post->title}}</li>
    <li>{{$post->content}}</li>
</ul>



<form action="{{route('posts.destroy', ['id' => $post->id])}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Deletar o Post: {{$post->id}}</button>
</form>
