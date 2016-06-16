@extends('layouts.index')

@section('title', $catalog->name)
@section('description', $catalog->description)

@section('content')
	<section style="width: 800px; margin: 0 auto;">
		<article class="catalog-item">
			@include('catalog.partials.item-header', $catalog->getAttributes(['name', 'slug']))
			@include('catalog.partials.item-address', ['address' => $catalog->address])

			<div class="catalog-description">{{ $catalog->description }}</div>

			@include('catalog.partials.item-info', $catalog->getAttributes(['phones', 'site', 'email', 'name']))

			<div class="catalog-content">{!! $catalog->content !!}</div>
			<div class="catalog-map">
				<h2>Автосервис {{ $catalog->name }} на карте</h2>
				@include('partials.map', ['address' => $catalog->address])
				<div id="map" class="map-middle"></div>
			</div>
			
			<div class="catalog-comment"></div>
		</article>
	</section>
@stop

@section('sidebar')
	<div class="catalog-similar">
		@inject('catalog', 'App\Catalog')
		
		<ul class="catalog-list-similar">
		@foreach($catalog->random(5) as $item)
			<li>
				<article class="catalog-item">
					@include('catalog.partials.item-header', $item->getAttributes(['name', 'slug']))
					<!-- <h1><a href="{{ route('catalog.show', [$item->slug]) }}">{{ $item->name }}</a></h1> -->
					<div>{{ $item->description }}</div>
					@include('catalog.partials.item-info', $item->getAttributes(['phones', 'site', 'email', 'name']))
				</article>
			</li>
		@endforeach
		</ul>
	</div>
@stop
