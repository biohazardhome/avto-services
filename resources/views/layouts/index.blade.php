<html><head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="description" content="@yield('description')">
	
	<link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/catalog.css" rel="stylesheet" type="text/css">
	<link href="/css/map.css" rel="stylesheet" type="text/css">
	
</head><body>

	<header>
		@include('menu')
	</header>

	<main>@yield('content')</main>
	
	<aside>@yield('sidebar')</aside>

	<footer>
		
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

</body></html>
