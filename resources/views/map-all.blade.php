@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово на карте')
@section('description', '')

@section('js')
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script src="/js/map.js" type="text/javascript"></script>
	<script src="/js/map-all.js" type="text/javascript"></script>

	<?php $city = isset($city) ? $city : null; ?>

	<script type="text/javascript">
		$(document).ready(function() {
			var city = '{{ ($city && isset($city->slug)) ? $city->slug : '' }}';
			var promise;

			if (city) {
				promise = mapCity(city);
			} else {
				promise = mapAll()
			}

			console.log(promise)

		});
	</script>
@stop

@section('head')
	<style type="text/css">
		html, body {
			/*width: 100%;*/
			height: 100%;
		}

		body {
			/*padding: 10px;*/
		}

		main {
			height: 100%;
		}

		section {
			height: 100%;
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
            /*min-height: 200px;*/
            /*max-height: 700px;*/
            height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
        	height: auto;
        }

        footer {
        	margin-top: 80px !important;
        }
    </style>
@stop

@section('content')
	<section class="col-lg-12">
		@if ($city)
			<h1>Автосервисы в {{ $city->name }}</h1>

			<div id="map-all"></div>
			<a href="/{{ $city->slug }}" title="">Все автосервисы в {{ $city->name }}</a>
		@else
			<h1>Все Автосервисы</h1>

			<div id="map-all"></div>
		@endif
		<!-- <p></p><p></p><p></p><p></p><p></p><p></p> -->
	</section>
@stop

@section('footer')
	<section class="col-lg-12">
		<style>
			.catalog-list-similar li {
				float: none;
				display: inline-block;
				vertical-align: top;
			}
		</style>

		@if (isset($catalog) && $catalog)
			<ul class="catalog-list-similar row">
				@foreach($catalog as $item)
					<li class="col-lg-4">
						<article class="catalog-item">
							@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
							@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
						</article>
					</li>
				@endforeach
			</ul>
		@endif
	</section>
@stop
