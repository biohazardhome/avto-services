
var Map = {

	create: function(id, options) {
		var optionsDefault = {center: [55.753994, 37.622093], zoom: 9};

		id = id || 'map';
        console.log(id);
		options = options || optionsDefault;

		return new ymaps.Map(id, {
			center: [55.753994, 37.622093],
			zoom: 9
		});
	},

	placemark: function(coordinate, data, options) {
		return new ymaps.Placemark(coordinate, this.placemarkData(data), {
			preset: 'islands#violetStretchyIcon',
			// hideIconOnBalloonOpen: false,
			// balloonCloseButton: false,
		});
	},

	placemarkData: function(attrs, index) {
		var site = '',
    		email = '',
    		phones = '';

    	if (attrs.site) {
			site = '<a href="http://'+ attrs.site +'/" blank="_target">'+ attrs.site +'</a>';
    	}

    	if (attrs.email) {
        	email = '<a href="mailto:'+ attrs.email +'">'+ attrs.email +'</a>';
    	}

    	if (attrs.phones) {
    		phones = attrs.phones.split(',');
    		if (phones.length > 1) {
    			phones = phones.map(function(i) { return i.trim(); })
    				.join(', ');
    		} else {
    			phones = phones;
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
            clusterCaption: attrs.name,
            balloonContentHeader: 'Автосервис <strong>"' + attrs.name + '"</strong>',
        };
	},

	geocode: function(request, options) {
		return ymaps.geocode(request, options);
	},

	clusterer: function() {
		return new ymaps.Clusterer({
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
        });
	}
}