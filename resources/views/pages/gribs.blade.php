@extends('templates.main')
@section('body')
<div class="row row-cols-3 row-cols-md-3 g-4 mt-1">
    @foreach($gribs as $grib) 
    @include('components.grib', ['id' => $grib->id, 'Name' => $grib->created_at , 'body' => $grib->Description,'createdAt' => $grib->created_at])
    @endforeach
</div>
@endsection



<!-- https://laravel.com/docs/9.x/blade -->