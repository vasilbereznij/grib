<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main templates</title>
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <script src="{{asset('assets/css/bootstrap.min.js')}}" defer>	</script>
</head>

<body>
	<Header>
		<div class="container">
			@include('components.navbar')
		</div>
	</Header>
	<main>
<div class="container">
	@yield('main')	
</div>
	</main>
	@yield('body')
</body>

</html>