@extends('layouts.index')

@section('title', 'Автосервис '. $catalog->name .' в Одинцово')
@section('description', $catalog->description)

@section('content')
	<section class="col-md-9 col-lg-9">
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
		@inject('similar', 'App\Catalog')
		
		<h3>Автосервисы на {{ $catalog->addressStreet }}</h3>
		<ul class="catalog-list-similar">
			@foreach($similar->LikeByAddress($catalog->addressStreet, 3) as $item)
				<li>
					<article class="catalog-item">
						@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
						@include('catalog.partials.item-address', $item->getAttributesOnly(['name', 'address']))
					</article>
				</li>
			@endforeach
		</ul>
	</div>

	<div class="catalog-similar">
		@inject('similar', 'App\Catalog')
		
		<h3>Автосервисы в {{ $catalog->addressCity }}</h3>
		<ul class="catalog-list-similar">
			@foreach($similar->LikeByAddress($catalog->addressCity, 3) as $item)
				<li>
					<article class="catalog-item">
						@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
						@include('catalog.partials.item-address', $item->getAttributesOnly(['name', 'address']))
					</article>
				</li>
			@endforeach
		</ul>
	</div>
@stop
