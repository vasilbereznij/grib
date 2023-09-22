   @extends('templates.main')
   @section('body')
      <form action="{{route('grib.create')}}" method="POST" enctype='multipart/form-data'>
      <!-- enctype='multipart/form-data' обяз атрибут для отправки файлов(52 ЗАГРУЗКА ФАЙЛОВ 2:10) -->
      @csrf

      <div class="mb-3 mt-3">
         <label for="title" class="form-label">NameUkr</label>
         <input type="text" name="NameUkr" value="{{ old('NameUkr') }}" class="form-control @error('NameUkr') is-invalid  @enderror" id="NameUkr">
         @error('NameUkr')
          <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  {{-- можно вывести на русском (см видео)  --}}
         </div>           
         @enderror
      </div>
            <div class="mb-3 mt-3">
         <label for="title" class="form-label">NameRus</label>
         <input type="text" name="NameRus" value="{{ old('NameRus') }}" class="form-control @error('NameRus') is-invalid  @enderror" id="NameRus">
         @error('NameRus')
          <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  
         </div>           
         @enderror
      </div>
            <div class="mb-3 mt-3">
         <label for="title" class="form-label">NameLat</label>
         <input type="text" name="NameLat" value="{{ old('NameLat') }}" class="form-control @error('NameLat') is-invalid  @enderror" id="NameLat">
         @error('NameLat')
          <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  
         </div>           
         @enderror
      </div>
      <div class="mb-3">
         <label for="body" class="form-label">Description</label>
         <textarea name="Description" value="{{ old('Description') }}" class="form-control @error('Description') is-invalid  @enderror" id="Description"></textarea> 
         {{-- |в textarea почему-то  old не работает| --}}
         @error('Description')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
      </div>

      <div class="mb-3">
         <label for="preview" class="form-label">Preview</label>
         <input type="file" value="{{ old('file') }}" class="form-control @error('preview') is-invalid  @enderror" name="preview" id="preview">
                  {{-- |почему-то  old не работает| --}}
      </div>
         @error('preview')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
         
      <div class="mb-3">
         <label for="body" class="form-label">Type1</label>
         <input type="number" step="1" min="1" max="4" name='Type1' value="{{ old('Type1') }}" class="form-control @error('Type1') is-invalid  @enderror" id='Type1'></textarea> 
      </div>

      <div class="mb-3">
         <label for="body" class="form-label">Type2</label>
         <input type="number" step="1" min="1" max="4" name='Type2' value="{{ old('Type2') }}" class="form-control @error('Type2') is-invalid  @enderror" id='Type2'></textarea> 
      </div>

      <div class="form-check mb-3">
         <input class="form-check-input" type="checkbox" name='is_public' id="is_public">
         <label class="form-check-label" for="is_public">
            is public
         </label>
      </div>
<button type="submit" class="btn btn-primary">Create</button>
   </form>
   @endsection