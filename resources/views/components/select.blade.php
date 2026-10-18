<!-- формування однієї категорії для selection.blade.php -->
<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$select->Title ?? null}}</h5>
            <p class="card-text"  style="height: 150px;">{{substr($select->Description, 0, 500).'...'  ?? null}}</p>
            <a href="/gribs/1"> <!-- куди перейти-->
                <img src={{ $image[$select->Type1]->GribImage }} class="card-img-top" alt="Фотр не знайдено" width='100' height='300px'>    
                {{-- <a href="{{ route('grib', ['grib' => $id])}}" class="btn btn-primary d-grid">Выбрать</a> --}}
            </a>
        </div>
    </div>
</div>