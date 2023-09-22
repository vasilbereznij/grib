@extends('templates.main')

@section('body')
{{-- @dd($selection); --}}
    <div class="jumbotron text-center"  style="background-color: rgba(255, 255, 255, 0.8);">
        <h1>Выбираем ниже!</h1>
        <p class="lead"  style="height: 80px;">{{substr($selection[0]->Description, 0, 500).'...'  ?? null}}</p> 
    </div>
    <div class="row row-cols-3 row-cols-md-4 g-4 mt-1">
    @foreach($selection as $select)
    {{-- @dd($select); --}}
    @if ($select->Type1 > 0)
     @include('components.select', ['body' => $select->Description])
     {{-- @include('components.grib', ['id' => $grib->id, 'body' => $grib->Description,'createdAt' => $grib->created_at]) --}}
    @endif
    @endforeach
    </div>
@endsection

@section('footer')
    <div class="container">
        <p class="float-left">&copy; My Company 2022</p>
        <p class="float-right">автор <a href="#" rel="external">Василь Бережний</a></p>
    </div>
@endsection

    {{-- <script src="./My Yii Application_files/bootstrap.bundle.js.загружено">
    </script> --}}
