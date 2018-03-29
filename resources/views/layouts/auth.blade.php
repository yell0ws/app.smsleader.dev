<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/animate/css/animate.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ asset('assets/plugins/formvalidation/css/formvalidation.min.css') }}" rel="stylesheet" type="text/css">
	@yield('css')
	<script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/plugins/formvalidation/js/formvalidation.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/plugins/formvalidation/js/bootstrap.min.js') }}" type="text/javascript"></script>
	@yield('js')
	</head>
	<body class="auth">
		@yield('content')
	</body>
</html>