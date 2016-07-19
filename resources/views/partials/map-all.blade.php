<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="/js/map.js" type="text/javascript"></script>
<script>

ymaps.ready(function () {
	var catalog = '{!! str_replace(['\r\n', '\n', '\t'], '', $catalog->toJson()) !!}',
		catalog = JSON.parse(catalog),
		data = [],
		promises = [];

	var myMap = Map.create('map-all');

	for (var name in catalog) {
		var item = catalog[name];
		var myGeocoder = ymaps.geocode(item.address);
		
		promises.push(myGeocoder);
		
		(function(item) {
			myGeocoder.then(
			    function(res) {
			   
        			data.push({
        				name: item.name,
        				description: item.description,
        				phones: item.phones,
        				site: item.site,
        				email: item.email,
        				coordinates: res.geoObjects.get(0).geometry.getCoordinates()
        			});
			    },
			    function (err) {
			        alert('Ошибка');
			    }
			);
		})(item);
	}

	Promise.all(promises)
		.then(function(values) {
			var clusterer = Map.clusterer(),
		        geoObjects = [];

		    for(var i = 0; i < data.length; i++) {
		    	var item = data[i],
		    		coordinate = item.coordinates;

		        geoObjects[i] = Map.placemark(coordinate, item);
		    }

		    clusterer.options.set({
		        gridSize: 80,
		        clusterDisableClickZoom: true
		    });

		    clusterer.add(geoObjects);
		    myMap.geoObjects.add(clusterer);

		    myMap.setBounds(clusterer.getBounds(), {
		        checkZoomRange: true
		    });
		});
});
</script>
<div id="map-all"></div>
