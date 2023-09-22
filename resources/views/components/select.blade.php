<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$select->Title ?? null}}</h5>
            <p class="card-text"  style="height: 150px;">{{substr($select->Description, 0, 500).'...'  ?? null}}</p>
            <img src={{ $image[0]->preview_image ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="card-img-top" alt="if не сработало" width='100' height='300px'>    
            {{-- <a href="{{ route('grib', ['grib' => $id])}}" class="btn btn-primary d-grid">Выбрать</a> --}}
        </div>
    </div>
</div>