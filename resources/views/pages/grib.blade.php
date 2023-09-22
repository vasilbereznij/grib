@extends('templates.main')
@section('body')
         {{-- @dd($GribName)  --}}
         @foreach ( $grib->GribNames as $GribName)
            <div class="card" style="width: 100%; margin-bottom: 10px; ">
            <div class="card-body">
                <h1 class="card-title">{{ $GribName->GribName }}</h1>
            </div>
        </div>
        @endforeach 


        @if ($grib->GribImage) {
            @foreach ( $grib->GribImage as $GribImage_ )
            <img src={{ $GribImage_->GribImage ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="card-img-top" alt=" не сработало" style="width: 10rem">
            <img src={{ $GribImage_->GribImage_preview ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="card-img-top" alt=" не сработало" style="width: 10rem">        
            @endforeach 
        }
        @endif
    
        @if ($grib->$GribDescription) {
            <p>{{$GribDescription[0]->Description}}</p>
        }
        @endif

    <h4>Comments</h4> 
    @foreach ( $grib->comments as $comment)
    <div class="card" style="width: 100%; margin-bottom: 10px; ">
        <div class="card-body">
            <h5 class="card-title">{{ $comment->username }}</h5>
            <p class="card-text">{{ $comment->body }}</p>
        </div>
    </div>
    @endforeach    
    
    <div class="btn-group">
         {{-- @dd($grib->id)  --}}
        <a href="{{ route('grib.page.egit', ['grib' => $grib->id])}}" class="btn btn-success">Edit</a>
        <Form action="{{ route('grib.delete',['grib' => $grib->id]) }}" method="POST">
            @csrf
        <button type="submit" class="btn btn-danger">Delete</button>    
        </Form>
    </div>
@endsection