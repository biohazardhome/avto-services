@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово на карте')
@section('description', '')

@section('js')
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script src="/js/map.js" type="text/javascript"></script>
	<script src="/js/map-all.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var promise = mapCity('{{ $city->slug }}')/*.done(function(data) {
				console.log(data)
			})*/;

			console.log(promise)

		});
	</script>
@stop

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

        #map-all {
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
		<h1>Автосервиса в {{ $city->name }}</h1>

		<div id="map-all"></div>
	</section>
@stop
