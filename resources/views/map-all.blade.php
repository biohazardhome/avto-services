@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово на карте')
@section('description', '')

@section('content')
	<style type="text/css">
		html, body, main, section {
			width: 100%;
			height: 100%;
		}

		body {
			/*padding: 10px;*/
		}

		section {
			
		}

		h1 {
			font-size: 16px;
		    text-transform: uppercase;
		    color: #615c5c;
		}

        #map {
            /*width: 700px;*/
            /*height: 450px;*/
            width: 100%;
            /*height: 700px;*/
            height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
        	height: auto;
        }
    </style>

	<section>
		<h1>{{ $catalog->count() }} Автосервиса в Одинцово</h1>

		<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		<script>

		ymaps.ready(init);

		

		function init() {
			var catalog = '{!! str_replace(['\r\n', '\n', '\t'], '', $catalog->toJson()) !!}',
				catalog = JSON.parse(catalog),
				data = [],
				promises = [],
				myMap = new ymaps.Map('map', {
				center: [55.753994, 37.622093],
				zoom: 9
			});

			// console.log(catalog);

			// var coordinates = [];
			// var promises = [];
			// addresses.forEach(function(address, name) {
			for (var name in catalog) {
				var item = catalog[name];
			// ['г. Одинцово, ш. Можайское, д. 52', 'г. Одинцово, ул. Акуловская, д. 11 А строение 3'].forEach(function(item) {
				var myGeocoder = ymaps.geocode(item.address);
				// var myGeocoder = ymaps.geocode('г. Одинцово, ш. Можайское, д. 52');
				
				promises.push(myGeocoder);
				
				(function(item) {
					myGeocoder.then(
					    function (res) {
					        // alert('Координаты объекта :' + res.geoObjects.get(0).geometry.getCoordinates());
					        // myMap.geoObjects.add(res.geoObjects.get(0));
					        // coordinates.push(res.geoObjects.get(0).geometry.getCoordinates());
					        // Выведем в консоль данные, полученные в результате геокодирования объекта.
		        			//console.log(res.geoObjects.get(0).properties.get('metaDataProperty'));
		        			// var arr = [];
		        			data.push({
		        				name: item.name,
		        				description: item.description,
		        				// address: item.address,
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
			// });

			Promise.all(promises)
				.then(function(values) {

					var clusterer = new ymaps.Clusterer({
				            // Зададим массив, описывающий иконки кластеров разного размера.
				            /*clusterIcons: [{
				                href: 'images/cat.png',
				                size: [40, 40],
				                offset: [-20, -20]
				            }],*/
				            // Эта опция отвечает за размеры кластеров.
				            // В данном случае для кластеров, содержащих до 100 элементов,
				            // будет показываться маленькая иконка. Для остальных - большая.
				            clusterNumbers: [10],
				            // clusterIconContentLayout: null,
				            /**
				             * Через кластеризатор можно указать только стили кластеров,
				             * стили для меток нужно назначать каждой метке отдельно.
				             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
				             */
				            preset: 'islands#invertedVioletClusterIcons',
				            /**
				             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
				             */
				            groupByCoordinates: false,
				            clusterDisableClickZoom: true,
				            clusterHideIconOnBalloonOpen: false,
				            geoObjectHideIconOnBalloonOpen: false
				        }),
				        getPointData = function(index, attrs) {
				        	var site = '',
				        		email = '',
				        		phones = '',
				        		phonesPrefix = '+7 ';

				        	if (attrs.site) {
								site = '<a href="http://'+ attrs.site +'/">'+ attrs.site +'</a>';
				        	}

				        	if (item.email) {
				            	email = '<a href="mailto:'+ attrs.email +'">'+ attrs.email +'</a>';
				        	}

				        	if (item.phones) {
				        		phones = item.phones.split(',');
				        		if (phones.length > 1) {
				        			phones = phones.map(function(i) { return phonesPrefix + i.trim(); })
				        			.join(', ');
				        		} else {
				        			phones = phonesPrefix + phones;
				        		}
				        	}

				            return {
				            	iconContent: attrs.name,
				            	// hintContent: '123',
				            	balloonContent: '4234234',
				            	
				            	balloonContentBody: attrs.description,
				            	balloonContentFooter: '<div>\
				            		<b>'+ phones +'</b><br>\
				            		'+ site +'\
				            		'+ email +'\
				            	</div>',

				                // balloonContentBody: 'балун <strong>метки ' + index + '</strong>',
				                // balloonContentBody: 'балун <strong>метки ' + index + '</strong>',
				                clusterCaption: item.name,
				                balloonContentHeader: 'Автосервис <strong>"' + item.name + '"</strong>',
				            };
				        },
				        geoObjects = [];

				    /*for(var i = 0, len = points.length; i < len; i++) {
				        // geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i));
				        geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i), {preset: 'islands#violetIcon'});
				        // geoObjects[i] = new ymaps.Placemark(points[i], { iconContent: 'Кремль' }, { preset: 'islands#redStretchyIcon' });
				    }*/

				    // var i = 0;
				    for(var i = 0; i < data.length; i++) {
				    	var item = data[i],
				    		// name = item,
				    		coordinate = item.coordinates;

				    	// console.log(item, coordinate)
				        // geoObjects[i] = new ymaps.Placemark(coordinate, getPointData(i, item), {preset: 'islands#violetIcon'});
				        geoObjects[i] = new ymaps.Placemark(coordinate, getPointData(i, item), {preset: 'islands#violetStretchyIcon'});
				        // i++;
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

			
		    
		}
		</script>
		<div id="map"></div>
	</section>
@stop
