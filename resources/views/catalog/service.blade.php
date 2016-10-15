@extends('layouts.index')

@section('title', '')
@section('description', 'Автосервисы в- каталог адресов и телефонов автосервисов в  с полной справочной информацией и отзывами') <!-- полная справочная информация, схема проезда-->


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

		<h1 class="text-center">{{ $service->name }}</h1>

		<p>{!! $service->content !!}</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			@include('catalog.item', compact('item', 'service'))
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


