@extends('templates.main')
<!-- всі гриби -->
@section('body')
<div class="row row-cols-3 row-cols-md-3 g-4 mt-1">

    @foreach($categories as $categorie) 
      <P> <h5 class="card-title">{{ $categorie->Title }}</h5></P>
    @endforeach 
    
</div>
@endsection



<!-- https://laravel.com/docs/9.x/blade -->