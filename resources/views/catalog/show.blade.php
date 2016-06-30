@extends('layouts.index')

@section('title', 'Автосервис '. $catalog->name .' в Одинцово')
@section('description', $catalog->description)

@section('content')
	<section class="col-md-8 col-lg-6 col-lg-offset-2">
		<article class="catalog-item">
			@include('catalog.partials.item-header', $catalog->getAttributesOnly(['name', 'slug']))
			@include('catalog.partials.item-address', $catalog->getAttributesOnly(['name', 'address']))

			<div class="catalog-description">{!! $catalog->description !!}</div>

			@include('catalog.partials.item-info', $catalog->getAttributesOnly(['phones', 'site', 'email', 'name']))

			<div class="catalog-content">{!! $catalog->content !!}</div>
			<div class="catalog-map">
				<h2>Автосервис "{{ $catalog->name }}" на карте</h2>
				@include('partials.map', ['catalog' => $catalogMap])
				<div id="map" style="width:auto; height: 450px;"></div>
			</div>

			<div class="catalog-comment">
				<h2>
					Автосервис "{{ $catalog->name }}" отзывы
				</h2>
				@include('comment.create', ['catalogId' => $catalog->id])
				
				@foreach($catalog->comments as $comment)
					@include('comment.show', $comment)
				@endforeach
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
					@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
					<!-- <h1><a href="{{ route('catalog.show', [$item->slug]) }}">{{ $item->name }}</a></h1> -->
					<div class="catalog-item-description">{{ $item->description }}</div>
					@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))
				</article>
			</li>
		@endforeach
		</ul>
	</div>
@stop
