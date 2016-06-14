<html><head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="description" content="@yield('description')">
	
	<link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/catalog.css" rel="stylesheet" type="text/css">
	
</head><body>

	<header></header>

	<main>@yield('content')</main>
	
	<aside>@yield('sidebar')</aside>

	<footer></footer>

</body></html>
