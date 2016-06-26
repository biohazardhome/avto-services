@extends('layouts.index')

@section('title', 'Автосервис '. $catalog->name .' в Одинцово')
@section('description', $catalog->description)

@section('content')
	<style>
		main {
			overflow: hidden;
			/*width: 1100px;*/
			max-width: 1200px;
    		margin: 0 auto;
		}

		section {
			float: left;
			max-width: 800px;
			/*min-width: 360px;*/
			margin: 0 auto;
		}

		aside {
			float: left;
		}

		footer {
			clear: both;
		}
	</style>
	<section>
		<article class="catalog-item">
			@include('catalog.partials.item-header', $catalog->getAttributes(['name', 'slug']))
			@include('catalog.partials.item-address', $catalog->getAttributes(['name', 'address']))

			<div class="catalog-description">{!! $catalog->description !!}</div>

			@include('catalog.partials.item-info', $catalog->getAttributes(['phones', 'site', 'email', 'name']))

			<div class="catalog-content">{!! $catalog->content !!}</div>
			<div class="catalog-map">
				<h2 style="text-align: center;">Автосервис "{{ $catalog->name }}" на карте</h2>
				@include('partials.map', ['catalog' => $catalogMap])
				<div id="map" class="map-middle"></div>
			</div>

			<div class="catalog-comment">
				<h2>
					Автосервис "{{ $catalog->name }}" в Одинцово отзывы
				</h2>
			</div>
		</article>
	</section>
@stop

@section('sidebar')
	<div class="catalog-similar">
		@inject('catalog', 'App\Catalog')
		
		<h3>Похожие сервисы</h3>
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
