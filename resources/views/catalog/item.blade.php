<?php $serviceSingularLcFirst = (isset($service) && isset($service->singular_lc_first)) ? $service->singular_lc_first : null;?>
<article class="catalog-item">
	@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
	@include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
	<div class="catalog-item-content" title="Подробнее об {{ $serviceSingularLcFirst }}е {{ $item->name }}">
		{!! $item->description !!}
	</div>
	@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))

	<a 
		href="{{ route('catalog.show', [$item->slug]) }}#comments" 
		title="Отзывы о {{ $serviceSingularLcFirst }}е {{ $item->name }}">
		Отзывы ({{ $item->comments_count }})
	</a>
</article>