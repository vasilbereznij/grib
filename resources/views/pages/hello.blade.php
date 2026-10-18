   @extends('templates.main')
   <!-- ???? -->
@section('body')
   <div class="row mt-4 bg-light" style="opacity: 0.5;">
       
            @if (auth()->guest())
            <H3 style="display: comment">Ви на сайті для грибників.</H3>
            @else
                   <h3> {{auth()->user()->name}}</h3> 
                   
            @endif

       <H1 style="display: comment">Заходьте, будь ласка!</H1>
   </div>
@endsection