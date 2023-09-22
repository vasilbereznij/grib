@extends('templates.main')
@section('main')
   <div class="row mt-4">
      <h3 class="mb-3"> Update "{{$article->title}}"</h3>
         <form action="{{route('articles.update', ['article'=>$article->id])}}" method="POST" enctype='multipart/form-data'>
      <!-- enctype='multipart/form-data' обяз атрибут для отправки файлов(52 ЗАГРУЗКА ФАЙЛОВ 2:10) -->
      @csrf
      <!-- см 51 Отправка форм -->
      <div class="mb-3">
         <label for="title" class="form-label">Title</label>
         <input type="text" name="title" value="{{ old('title',$article->title) }}" class="form-control @error('title') is-invalid  @enderror" id="title">
         @error('title')
          <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}  {{-- можно вывести на русском (см видео)  --}}
         </div>           
         @enderror
      </div>
      <div class="mb-3">
         <label for="body" class="form-label">body</label>
         <textarea name="body" class="form-control @error('body') is-invalid  @enderror"  id="body"> {{ old('body',$article->body) }}</textarea> 
         @error('body')
         <div id="validationCustom03" class="invalid-feedback">
            {{ $message }}
         </div>           
         @enderror
      </div>


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
      <div class="form-check mb-3">
         <input class="form-check-input" type="checkbox" name='is_public' value="" id="is_public" {{ (bool)$article -> is_public === true ? 'checked' : '' }}>
         <label class="form-check-label" for="is_public">
            is public
         </label>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
   </form>
   </div>
@endsection
