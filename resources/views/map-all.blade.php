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
    </style>
@stop

@section('content')
	<section class="col-lg-12">
		<h1>Автосервисы в {{ $city->name }}</h1>

		<div id="map-all"></div>
		<a href="/{{ $city->slug }}" title="">Все автосервисы в {{ $city->name }}</a>
		<p></p><p></p><p></p><p></p><p></p><p></p>
	</section>

	<section class="col-lg-12">
		@inject('catalog', 'App\Catalog')
		
		<!-- <h3>Популярные {{ $catalog->addressCityShort }}</h3> -->
		<style>
			.catalog-list-similar li {
				float: none;
				display: inline-block;
				vertical-align: top;
			}
		</style>

		<ul class="catalog-list-similar row">
			@foreach($catalog->whereCityId($city->id)->orderBy('sort', 'desc')->limit(6)->get() as $item)
				<li class="col-lg-4">
					<article class="catalog-item">
						@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
						@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
					</article>
				</li>
			@endforeach
		</ul>
	</section>
@stop
