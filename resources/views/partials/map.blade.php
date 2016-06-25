
	<!-- <style type="text/css">
        html, body, #map {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style> -->
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script src="/js/map.js" type="text/javascript"></script>
	<script>
	ymaps.ready(init);

	function init() {

		var catalog = JSON.parse('{!! str_replace(['\r\n', '\n', '\t'], '', json_encode($catalog)) !!}'),
			myMap = Map.create();

		Map.geocode('{{ $address }}', {results: 1})
			.then(function(res) {
				var firstGeoObject = res.geoObjects.get(0),
					coords = firstGeoObject.geometry.getCoordinates(),
					bounds = firstGeoObject.properties.get('boundedBy'),
					placemark = Map.placemark(coords, catalog);

				// myMap.geoObjects.add(firstGeoObject);
				myMap.geoObjects.add(placemark);
				myMap.setBounds(bounds, {
					checkZoomRange: true
				});

			});
	}
	</script>
	<!-- <div id="map"></div> -->

