@extends('layouts.index')

@section('title', 'Местоположение автосервиса '. (!empty($name) ? $name : $address) .' на карте')

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
	</style>
	<h1>Автосервис {{ (!empty($name) ? $name : $address) }} на карте</h1>
	<p><address>Адрес: {{ $address }}</address></p>
	<a href="{{ route('catalog.index') }}" title="Все автосервисы в Одинцово">Все автосервисы в Одинцово</a>
	@include('partials.map', compact('address'))
	<div id="map"></div>
@stop