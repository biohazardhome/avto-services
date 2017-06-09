@extends('layouts.index')

<?php
	$city = $catalog->city;
	$service = $catalog->service;
?>

@section('title', $service->singular .' '. $catalog->name .' '. $city->name)
@section('description', trim(str_limit_with(strip_tags($catalog->description), 200)) )
@section('content')
	<section class="catalog-show col-md-9 col-lg-9">

		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add($service->name, '/'. $city->slug .'/'. $service->slug);
			Breadcrumbs::add($city->name, '/'. $city->slug .'/'. $service->slug);
			Breadcrumbs::add($catalog->name, '/'. $catalog->slug);
		?>

		

		<article class="catalog-item ">

			{!! Breadcrumbs::render() !!}

			<div class="catalog-item-well">
				@include('catalog.partials.item-header', $catalog->getAttributesOnly(['name']) + ['city' => $catalog->city])
				@include('catalog.partials.item-address-short', ['item' => $catalog])

				<div class="catalog-description">{!! $catalog->description !!}</div>

				@include('catalog.marks', compact('catalog'))

				@include('catalog.partials.item-info', $catalog->getAttributesOnly(['phones', 'site', 'email', 'name']))

				<div class="catalog-content">{!! $catalog->content !!}</div>

				<div class="catalog-gallery">
					<?php $images = new My\Service\ImageCollection($catalog->images);?>
					@include('image.list-horizontal', compact('images', 'catalog', 'service'))
				</div>

				<div>
					<a 
						href="{{ route('main', [$city->slug, $service->slug]) }}" 
						title=""
					>Все {{ $service->name }} в {{ $city->name }}</a>
				</div>
			</div>

			<div class="catalog-map catalog-item-well">
				<a name="map"></a>
				<h2>{{ $service->singular }} "{{ $catalog->name }}" на карте</h2>
				@include('partials.map', ['catalog' => $catalogMap])
				<div id="map" style="width:auto; height: 450px;"></div>
				<a href="/map/{{ $catalog->city->slug }}/">Все {{ $service->nameLcFirst }} в {{ $catalog->city->name}} на карте</a>
			</div>

			<div class="catalog-comment catalog-item-well">
				<a name="comments"></a>
				
				<div class="comment-actions">
					<div class="comment-actions pull-right">
						<a href="#" class="comment-form-show btn btn-default" title="Показать форму отзывов">Написать</a>
					</div>
					<h2>
						Отзывы об {{ $service->singularLcFirst }}е "{{ $catalog->name }}" в {{ $catalog->city->name }}
					</h2>
				</div>
				@include('comment.create', ['catalogId' => $catalog->id])
				@include('comment.index', ['comments' => $catalog->comments])
				
			</div>
		</article>
		
	</section>
@stop

@section('sidebar')
	<aside class="col-sm-12 col-md-3 col-lg-3">
		<div class="catalog-similar-wrap">

			@inject('similar', 'App\Catalog')

			<?php $similar = $similar->whereNot('id', $catalog->id);?>

			<div class="catalog-similar">
				<h3>{{ $service->name }} на {{ $catalog->addressStreet }}</h3>
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
				
				
				<h3>{{ $service->name }} в городе {{ $catalog->addressCityShort }}</h3>
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

			<div class="catalog-similar">
				
				
				<h3>Популярные {{ $service->nameLcFirst }} {{ $catalog->addressCityShort }} в {{ $city->name }}</h3>
				<ul class="catalog-list-similar">
					@foreach($similar->whereCityId($city->id)->orderBy('sort', 'desc')->limit(3)->get() as $item)
						<li>
							<article class="catalog-item">
								@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
								@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
							</article>
						</li>
					@endforeach
				</ul>
			</div>
			<div>
		</div>
	</aside>
@stop
