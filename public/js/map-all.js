
// var map = {};

function prepare(data, dfd) {
	// console.log(data)
	var catalog = /*JSON.parse(*/data/*)*/,
		data = [],
		promises = [];

	var myMap = Map.create('map-all');


	// console.log(promise)
	function prepareData(items) {
		for (var name in items) {
			var item = items[name];
			// console.log(item);
			// break;
		// items.forEach(function(item, name) {
			var item = items[name];
			var myGeocoder = ymaps.geocode(item.address);
			
			promises.push(myGeocoder);
			
			(function(item) {
				myGeocoder.then(function(res) {
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
			   	});
			})(item);
		// });
		}
		return promises;
	}

	promises = prepareData(catalog);

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

			dfd.resolve(catalog);
		});

}

function mapAll() {
	var promise,
		dfd = $.Deferred();
	
	console.log(dfd)
	
	ymaps.ready(function () {
		promise = $.get('/map/all-ajax/', {}, function(data) {
			prepare(data, dfd);
		});
	});
	// console.log(dfd.promise())
	// return promise;
	return dfd.promise();
}

function mapCity(city) {

	/*.done(function(data) {
		console.log(321)
	})*/;

	var promise,
		dfd = $.Deferred();
	
	console.log(dfd)
	
	ymaps.ready(function () {
		promise = $.get('/map/city-ajax/'+ city, {}, function(data) {
			prepare(data, dfd);
		});
	});
	// console.log(dfd.promise())
	// return promise;
	return dfd.promise();
}