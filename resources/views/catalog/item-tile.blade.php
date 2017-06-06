<?php $serviceSingularLcFirst = (isset($service) && isset($service->singular_lc_first)) ? $service->singular_lc_first : null;?>

<article class="catalog-item col-md-6">
	@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
	@include('catalog.partials.item-address-short-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
	
	<div class="catalog-gallery">
		<?php $images = new My\Service\ImageCollection($item->images);?>
		@include('image.list-horizontal', compact('images', 'service') + ['catalog' => $item])
	</div>

	<div class="catalog-item-content" title="Подробнее об {{ $serviceSingularLcFirst }}е {{ $item->name }}">
		{!! str_limit($item->description, 200) !!}
	</div>
	@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))

	<a 
		href="{{ route('catalog.show', [$item->slug]) }}#comments" 
		title="Отзывы о {{ $serviceSingularLcFirst }}е {{ $item->name }}">
		Отзывы ({{ $item->comments_count }})
	</a>
</article>