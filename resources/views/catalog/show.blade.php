@extends('layouts.index')

@section('title', 'Автосервис '. $catalog->name .' в Одинцово')
@section('description', $catalog->description)

@section('content')
	<section class="catalog-show col-md-9 col-lg-9">
		<article class="catalog-item bg-gray">
			<div class="catalog-item-well">
				@include('catalog.partials.item-header', $catalog->getAttributesOnly(['name', 'slug']))
				@include('catalog.partials.item-address', $catalog->getAttributesOnly(['name', 'address']))

				<div class="catalog-description">{!! $catalog->description !!}</div>

				@include('catalog.partials.item-info', $catalog->getAttributesOnly(['phones', 'site', 'email', 'name']))

				<div class="catalog-content">{!! $catalog->content !!}</div>
			</div>

			<div class="catalog-map catalog-item-well">
				<a name="map"></a>
				<h2>Автосервис "{{ $catalog->name }}" на карте</h2>
				@include('partials.map', ['catalog' => $catalogMap])
				<div id="map" style="width:auto; height: 450px;"></div>
			</div>

			<div class="catalog-comment catalog-item-well">
				<a name="comments"></a>
				
				<div class="comment-actions">
					<div class="comment-actions pull-right">
						<a href="#" class="comment-form-show btn btn-default" title="Показать форму отзывов">Написать</a>
					</div>
					<h2>
						Отзывы о Автосервисе {{ $catalog->name }} в Одинцово
					</h2>
				</div>
				@include('comment.create', ['catalogId' => $catalog->id])
				@include('comment.index', ['comments' => $catalog->comments])
				
			</div>
		</article>
		
	</section>
@stop

@section('sidebar')
	<aside class="col-md-3 col-lg-3">
		<div class="catalog-similar">
			@inject('similar', 'App\Catalog')
			
			<h3>Автосервисы на {{ $catalog->addressStreet }}</h3>
			<ul class="catalog-list-similar">
				@foreach($similar->LikeByAddress($catalog->addressStreet, 3) as $item)
					<li>
						<article class="catalog-item">
							@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
							@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
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
							@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
						</article>
					</li>
				@endforeach
			</ul>
		</div>
	</aside>
@stop
