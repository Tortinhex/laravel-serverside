<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	@if(Config::get('app.debug'))
		<link href="{{ asset('build/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('build/css/vendor/bootstrap-theme.min.css') }}" rel="stylesheet">
	@else
		<link href="{{ elixir('css/all.css') }}" rel="stylesheet">
	@endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Welcome</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest())
						@if(!Request::is('auth/login'))
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
						@endif
						@if(!Request::is('auth/register'))
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@endif
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}" type="text/javascript"></script>
	@else
		<script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>
	@endif
</body>
</html>
