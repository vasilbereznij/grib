@extends('templates.main')
@section('body')
   <div class="row mt-4">
          {{-- @dd($grib->id)  @dd($grib->GribNames[0]->Language)   @dd($grib->Description[0]->Description) @dd($Description_['Description'])  --}}
          
      <h3 class="mb-3"> Update "{{$grib->GribNames[0]->GribName   ??  NULL }}"</h3>
         <form action="{{route('grib.update', ['grib'=>$grib->id])}}" method="POST" enctype='multipart/form-data'>
      <!-- enctype='multipart/form-data' обяз атрибут для отправки файлов(52 ЗАГРУЗКА ФАЙЛОВ 2:10) -->
      @csrf
      <!-- см 51 Отправка форм -->
      @foreach ( $grib->GribNames as $GribName)
        <div class="d-flex mb-3 bd-highlight">
            <div class="form-group">
               <select name="Name[{{ $GribName->id }}][Language]" value="" class="form-control @error('Language') is-invalid  @enderror" id="Language">
                  <option>{{ $GribName->Language }}</option>
                  <option>ua</option>
                  <option>ru</option>
                  <option>en</option>
               </select>
            </div>
            <input type="text" name="Name[{{ $GribName->id }}][Name]" value="{{ $GribName->GribName }}" class="form-control @error('GribName') is-invalid  @enderror" id="GribName">
       </div>
         @error('GribName')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  {{-- можно вывести на русском (см видео)  --}}
         </div>           
         @enderror
       @endforeach 
       
       @foreach ( $grib->Description as $Description_)
        <div class="d-flex mb-3 bd-highlight">
           <div class="form-group">
               <select name="Description[{{ $Description_->id }}][Language]" value="" class="form-control @error('Language') is-invalid  @enderror" id="Language">
                  <option>{{ $Description_->Language }}</option>
                  <option>ua</option>
                  <option>ru</option>
                  <option>en</option>
               </select>
            </div>
            <textarea name="Description[{{ $Description_->id }}][Description]" id="text" rows="10" cols="80"><?= $_POST['Description'] ?? $Description_['Description'] ?></textarea><br> -->
            <!-- <input type="text" name="Description" value="{{ old('Description', $Description_['Description']) }}" class="form-control @error('GribName') is-invalid  @enderror" id="GribName"> -->
          </div>
            <!-- <textarea name="Description" value="{{ old('Description', $Description_['Description']) }}" class="form-control @error('Description') is-invalid  @enderror" id="Description"></textarea> 
            <textarea name="text" id="text" rows="10" cols="80"><  убрати пробіли ?= $_POST['Description'] ?? $Description_['Description'] ?></textarea><br> -->
            {{-- |в textarea почему-то  old не работает| --}}
         @error('Description')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
       @endforeach 
      
      <div class="mb-3">
         <img height='100' src={{ $grib->GribImage[0]->GribImage ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="d-block mb-3" alt="if не сработало" width='100'>
                  <label for="preview" class="form-label">Preview</label>
         <input type="file" name="preview" class="form-control @error('preview') is-invalid  @enderror"  id="preview" value="{{ old('file') }}">
                  {{-- |почему-то  old не работает| --}}
      </div>

         @error('preview')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror

         <div class="mb-3">
         <img height='100'src={{ $article->preview_image ?? 'https://tryndiani.com.ua/img/instrumenty/1.jpg' }} class="d-block mb-3" alt="if не сработало" width='100'>
         <label for="preview" class="form-label">Preview</label>
         <input class="form-control @error('preview') is-invalid  @enderror" name="preview" type="file" id="preview" value="{{ old('file') }}">
                  {{-- |почему-то  old не работает| --}}
      </div>
         @error('preview')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror

         <div class="mb-3">
         <label for="body" class="form-label">Type1</label>
         <input type="number" step="1" min="1" max="4" name='Type1' value="{{old('Type1', $grib->Type1)}}" class="form-control @error('Type1') is-invalid  @enderror" id='Type1'></textarea> 
      </div>

      <div class="mb-3">
         <label for="body" class="form-label">Type2</label>
         <input type="number" step="1" min="1" max="4" name='Type2' value="{{old('Type2', $grib->Type2)}}" class="form-control @error('Type2') is-invalid  @enderror" id='Type2'></textarea> 
      </div>

      <div class="form-check mb-3">
         <input class="form-check-input" type="checkbox" name='is_public' value="1" id="is_public" {{ (bool)$grib -> is_public === true ? 'checked' : '' }}>
         <label class="form-check-label" for="is_public">
            is public
         </label>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
   </form>
   </div>
@endsection
