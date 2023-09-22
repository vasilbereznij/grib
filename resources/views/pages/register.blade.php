@extends('templates.main')
@section('body')
   <div class="row mt-4">
      @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
               {{ session()->get('success') }}  
            </div>
      @endif   
      <form action="{{route('register.action')}}" method="POST">
         @csrf
         <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror" id="name">
            @error('name')
            <div id="validationCustom03" class="invalid-feedback">
               {{ $message }} 
            </div>           
            @enderror
         </div>
         <div class="mb-3">
            <label for="email" class="form-label">e-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid  @enderror" id="email">
            @error('email')
            <div id="validationCustom03" class="invalid-feedback">
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
         <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password confirmation</label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation"> 
         </div>
         <button type="submit" class="btn btn-primary"> Create account </button>
      </form>
   </div>
@endsection