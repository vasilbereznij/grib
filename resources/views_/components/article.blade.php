<div class="col">
    <div class="card">
        <img src={{ $article->preview_image ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="card-img-top" alt="if не сработало" width='100'>    
        <div class="card-body">
            <h5 class="card-title">{{$article->title ?? null}}</h5>
            <p class="card-text">{{substr($article->body, 0, 145).'...'  ?? null}}</p>
            {{-- substr глючить: розібратись  --}}
            <p class="card-text"><small class="text-muted"> {{ $article->created_at }} </small></p>
            <a href="{{ route('article', ['article' => $id])}}" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
</div>