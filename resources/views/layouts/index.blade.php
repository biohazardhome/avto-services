<!DOCTYPE html>
<html><head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<meta name="description" content="@yield('description')">
	
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/catalog.css" rel="stylesheet" type="text/css">
	<link href="/css/comment.css" rel="stylesheet" type="text/css">
	<link href="/css/map.css" rel="stylesheet" type="text/css">
	<link href="/css/media.css" rel="stylesheet" type="text/css">

	@yield('head')
	
</head><body class="container-fluid">

	<header class="row">
		@include('menu')
	</header>

	<main class="row">
		@yield('content')
		@yield('sidebar')

		{!! $composerCommentsIndex or '' !!}

	</main>
	
	

	<footer class="row">

		{!! $composerMapIndex or '' !!}

		<u>Автосервисы в городах</u>
		<?php $cities = App\City::all() ?>
		<ul>
			@foreach($cities as $city)
				<li><a href="{{ $city->slug }}">{{ $city->name }}</a></li>
			@endforeach
		</ul>
		
		<!-- Yandex.Metrika informer -->
		<a href="https://metrika.yandex.ru/stat/?id=37981900&amp;from=informer"
		target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/37981900/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
		style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:37981900,lang:'ru'});return false}catch(e){}" /></a>
		<!-- /Yandex.Metrika informer -->

		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
		    (function (d, w, c) {
		        (w[c] = w[c] || []).push(function() {
		            try {
		                w.yaCounter37981900 = new Ya.Metrika({
		                    id:37981900,
		                    clickmap:true,
		                    trackLinks:true,
		                    accurateTrackBounce:true,
		                    webvisor:true
		                });
		            } catch(e) { }
		        });

		        var n = d.getElementsByTagName("script")[0],
		            s = d.createElement("script"),
		            f = function () { n.parentNode.insertBefore(s, n); };
		        s.type = "text/javascript";
		        s.async = true;
		        s.src = "https://mc.yandex.ru/metrika/watch.js";

		        if (w.opera == "[object Opera]") {
		            d.addEventListener("DOMContentLoaded", f, false);
		        } else { f(); }
		    })(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/37981900" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
	</footer>

	<script src="/js/jquery-3.0.0.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
	<script src="/js/comment.js" type="text/javascript"></script>

</body></html>
