<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="определитель, справочник, грибов">
    <meta name="description" content="Сайт для практического быстрого определения распространенных грибов.">
    <title>Определитель грибов</title>   
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <script src="{{asset('assets/css/bootstrap.min.js')}}" defer>	</script>
</head>

<Header>
	<div class="container">
		@include('components.navbar')
	</div>
</Header>

<body class="d-flex flex-column h-100 page-header" style="background-image: url('/storage/grib/previews/mwMpH8zj4k1TOglf4DARYOy34EP4ASHeAylloyal.jpg');
height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
	<main role="main" class="flex-shrink-0">
		<div class="container page-header pt-5" >
		@yield('body')
		</div>
	</main>
</body>
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; My Company 2022</p>
        <p class="float-right">автор <a href="#" rel="external">Василь Бережний</a></p>
    </div>
	{{-- @yield('footer') --}}
</footer>

</html>