@extends('layouts.index')

{{-- @section('title', $service->name .' в Москве на карте с отзывами, адресами и телефонами') --}}
{{-- @section('description', 'Автосервисы в Москве каталог адресов и телефонов автосервисов в Москве с полной справочной информацией и отзывами') <!-- полная справочная информация, схема проезда--> --}}

@if (empty($city))
	@section('title', $service->name)
	@section('description', $service->name)
@else
	@section('title', $service->name .' в '. $city->name .' на карте с отзывами, адресами и телефонами')
	@section('description', $service->name .' в '. $city->name .' каталог адресов и телефонов автосервисов в '. $city->name .' с полной справочной информацией и отзывами')
@endif



@section('head')
	<link rel="canonical" href="{{ route('catalog.index') }}/" />
@stop

@section('content')

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		
		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add($service->name, '/'. $service->slug);
		?>

		{!! Breadcrumbs::render() !!}

		<h1 class="text-center">
			{{ $service->name }}

			@if (isset($city))
				 в 
				{{ $city->name }}
			@endif
		</h1>

		<p>{!! $service->content !!}</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			@include('catalog.item', compact('item', 'service'))
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


