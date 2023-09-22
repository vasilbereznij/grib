@extends('templates.main')
@section('main')
    <h1>{{$article->title}}</h1>
    @if($article->preview_image)
        <img src={{ $article->preview_image }} class="card-img-top" alt="if не сработало" style="width: 10rem;">    
    @endif
    <p>{{$article->body}}</p>
    <h4>Comments</h4> 
    @foreach ( $article->comments as $comment)
    <div class="card" style="width: 100%; margin-bottom: 10px; ">
        <div class="card-body">
            <h5 class="card-title">{{ $comment->username }}</h5>
            <p class="card-text">{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach    
    
    <div class="btn-group">
        <a href="{{ route('article.page.egit', ['article' => $article->id])}}" class="btn btn-success">Edit</a>
        <Form action="{{ route('articles.delete',['article' => $article->id]) }}" method="POST">
            @csrf
        <button type="submit" class="btn btn-danger">Delete</button>    
        </Form>
    </div>
@endsection