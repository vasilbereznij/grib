<div class="col">
    <div class="card card-body">
{{-- {{var_dump($grib->GribNames)}} --}}
        @foreach ( $grib->GribNames as $GribName)
            <div class="card" style="width: 100%; margin-bottom: 10px; ">
            <div class="card-body">
                <h5 class="card-title">{{ $GribName->GribName }}</h5>
            </div>
        </div>
        @endforeach 

        <h5 class="card-title">{{$grib->created_at ?? null}}</h5>
        
        @foreach ( $grib->Description as $Description_)
            <div class="card" style="width: 100%; margin-bottom: 10px; ">
                <div class="card-body">
                    <p class="card-text"  style="height: 100px;">{{mb_substr($Description_->Description, 0, 190).'...'  ?? 'null'}}</p>
                </div>
            </div>
        @endforeach 
        
        @foreach ( $grib->GribImage as $GribImage_ )
            <img src={{ $GribImage_->GribImage ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="card-img-top" alt="if не сработало" width='100' height='300px'>    
        @endforeach 

        @foreach ( $grib->comments as $comment)
        <div class="card" style="width: 100%; margin-bottom: 10px; ">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->username }}</h5>
                <p class="card-text">{{ $comment->comment }}</p>
            </div>
        </div>
        @endforeach  
        
        <a href="{{ route('grib', ['grib' => $id])}}" class="btn btn-primary d-grid">Выбрать</a>
    </div>
</div>