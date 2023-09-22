@extends('templates.main')
@section('main')
<div class="row row-cols-3 row-cols-md-3 g-4 mt-1">
    @foreach($articles as $article)
    @include('components.article', ['id' => $article->id, 'title' => $article->title, 'body' => $article->body,'createdAt' => $article->created_at])
    {{-- @include('components.article', ['id' => $article->id, 'title' => $article->name, 'body' => $article->body]) --}}
    {{-- @include('components.article', ['id' => $article['id'], 'title' => $article['title'], 'body' => $article['body']]) --}} 
    @endforeach
</div>
@endsection



<!-- https://laravel.com/docs/9.x/blade -->