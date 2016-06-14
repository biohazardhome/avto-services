@extends('layouts.index')

@section('content')
	<style type="text/css">
        html, body, #map {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script>
	ymaps.ready(init);

	function init() {
		var myMap = new ymaps.Map('map', {
			center: [55.753994, 37.622093],
			zoom: 9
		});

		// Find coordinates of the center of Nizhny Novgorod.
		ymaps.geocode({{ $address }}, {
			/**
			 * Request options
			 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
			  */
			// Sorting the results from the center of the map window. boundedBy: myMap.getBounds(),
			// strictBounds: true, Together with the boundedBy option, the search will be strictly
			// inside the area specified in boundedBy. If you need only one result, we're saving the
			// users bandwidth.
			results: 1
		}).then(function (res) {
				// Selecting the first result of geocoding.
				var firstGeoObject = res.geoObjects.get(0),
					// The coordinates of the geo object.
					coords = firstGeoObject.geometry.getCoordinates(),
					// The viewport of the geo object.
					bounds = firstGeoObject.properties.get('boundedBy');

				// Adding first found geo object to the map.
				myMap.geoObjects.add(firstGeoObject);
				// Scaling the map to the geo object viewport.
				myMap.setBounds(bounds, {
					// Checking the availability of tiles at the given zoom level.
					checkZoomRange: true
				});
		});
	}
	</script>
	<div id="map"></div>
@endsection
