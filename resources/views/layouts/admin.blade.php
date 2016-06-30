<!DOCTYPE html>
<html><head>
	<title>Админка @yield('title')</title>
	<meta charset="utf-8">
	<meta name="description" content="@yield('description')">
	
	
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/catalog.css" rel="stylesheet" type="text/css">
	<link href="/css/map.css" rel="stylesheet" type="text/css">

	@yield('assetsCSS')
	
</head><body>

	<header>
		<ul>
			<li><a href="/admin">Админка</a></li>
			<li><a href="/admin/catalog">Каталог</a></li>
			<li><a href="/" target="_blank">Сайт</a></li>
		</ul>
	</header>

	<main>@yield('content')</main>
	
	<aside>@yield('sidebar')</aside>

	<footer>
		

	</footer>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
	<!-- <script src="/js/jquery-3.0.0.min.js" type="text/javascript"></script> -->
	@yield('assetsJS')

</body></html>
