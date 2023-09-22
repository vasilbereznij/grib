@extends('templates.main')
@section('body')
   <div class="row mt-4">   
      <form action="{{route('login.action')}}" method="POST">
         @csrf
         @error('auth_error')
            <div class="alert alert-danger" role="alert">
               {{ $message }}  
            </div>
         @enderror
         <div class="mb-3">
            <label for="email" class="form-label">e-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid  @enderror" id="email">
            @error('email')
            <div id="validationServer03Feedback" class="invalid-feedback">
               {{ $message }}  
            </div>           
            @enderror
         </div>
         <div class="mb-3">
            <label for="Password" class="form-label">password</label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid  @enderror" id="password"> 
            @error('password')
            <div id="validationServer03Feedback" class="invalid-feedback">
               {{ $message }}
            </div>           
            @enderror
         </div>
         <button type="submit" class="btn btn-primary"> Sing in </button>
      </form>
   </div>
@endsection