@extends('layouts.index')

@section('title', 'Автосервис '. $address .' на карте')

@section('content')
	@include('partials.map', compact('address'))
	<div id="map" class="map-full"></div>
@stop