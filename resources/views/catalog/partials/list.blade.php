<li>
	<article class="catalog-item">
		@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
		<div class="catalog-item-description">{!! str_limit($item->description, 100) !!}</div>
		@include('catalog.partials.item-address-short-anchor', $item->getAttributesOnly(['slug', 'name', 'address']))
	</article>
</li>