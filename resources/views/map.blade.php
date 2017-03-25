@extends('layouts.index')

@section('title', 'Местоположение автосервиса '. $catalog->name .' на карте')

@section('js')
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="/js/map.js" type="text/javascript"></script>
    <script src="/js/map-all.js" type="text/javascript"></script>
@stop

@section('content')
	<style>
		/* html, body,  */#map {
            /*width: 600px;*/
            /*height: 450px;*/
            width: 100%;
            height: 700px;
            margin: 0;
            padding: 0;
        }

        h1 {
        	text-align: center;
        }

        main.row {
            background-color: white;
            padding: 25px;
        }
	</style>
	<h1>Автосервис <a href="{{ route('catalog.show', [$catalog->slug]) }}" title="Автосервис {{ $catalog->name }} в Одинцово">{{ $catalog->name }}</a> на карте</h1>
	<p><address>Адрес: {{ $catalog->address }}</address></p>
	<!-- <a href="{{ route('catalog.index') }}" title="Все автосервисы в Одинцово">Все автосервисы в Одинцово</a> -->
	@include('partials.map', ['catalog' => $catalog])
	<div id="map"></div>
@stop