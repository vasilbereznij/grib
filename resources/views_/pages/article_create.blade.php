   @extends('templates.main')
   @section('main')
   <form action="{{route('articles.create')}}" method="POST" enctype='multipart/form-data'>
      <!-- enctype='multipart/form-data' обяз атрибут для отправки файлов(52 ЗАГРУЗКА ФАЙЛОВ 2:10) -->
      @csrf
      <!-- см 51 Отправка форм -->
      <div class="mb-3">
         <label for="title" class="form-label">Title</label>
         <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid  @enderror" id="title">
         @error('title')
          <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  {{-- можно вывести на русском (см видео)  --}}
         </div>           
         @enderror
      </div>
      <div class="mb-3">
         <label for="body" class="form-label">body</label>
         {{-- <input name="body" value="{{ old('body') }}" class="form-control @error('body') is-invalid  @enderror" id="body"> --}}
         <textarea name="body" value="{{ old('body') }}" class="form-control @error('body') is-invalid  @enderror" id="body"></textarea> 
         {{-- |в textarea почему-то  old не работает| --}}
         <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
         @error('body')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
      </div>


      <div class="mb-3">
         <label for="preview" class="form-label">Preview</label>
         <input type="file" value="{{ old('file') }}"class="form-control @error('preview') is-invalid  @enderror" name="preview" id="preview">
                  {{-- |почему-то  old не работает| --}}
      </div>
         @error('preview')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
      <div class="form-check mb-3">
         <input class="form-check-input" type="checkbox" name='is_public' id="is_public">
         <label class="form-check-label" for="is_public">
            is public
         </label>
      </div>
<button type="submit" class="btn btn-primary">Create</button>
   </form>
   @endsection