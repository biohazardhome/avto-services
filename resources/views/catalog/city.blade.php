@extends('layouts.index')

@section('title', $city->title)
@section('description', $city->description) <!-- полная справочная информация, схема проезда-->


@section('head')
	<link rel="canonical" href="{{ route('catalog.index') }}/" />
@stop

@section('content')

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		
		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add('Автосервисы', '/');
			Breadcrumbs::add($city->name, '/'. $city->slug);
		?>

		{!! Breadcrumbs::render() !!}

		<h1 class="text-center">Автосервисы в {{ $city->name }}</h1>

		<p>{{ $city->text }}</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			<article class="catalog-item">
				@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
				@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
				<div class="catalog-item-content" title="Подробнее об автосервисе {{ $item->name }}">
					{!! $item->description !!}
				</div>
				@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))

				<a href="{{ route('catalog.show', [$item->slug]) }}#comments" title="Отзывы о автосервисе {{ $item->name }}">Отзывы ({{ $item->comments_count }})</a>
			</article>
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


