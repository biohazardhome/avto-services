
<style>
	.phone {
		display: inline-block;
		padding-right: 20px;
	}
</style>

<div class="phone">
	<a href="{{ route('catalog.show', $item->slug) }}" title="">{{ $item->phones }}</a>
</div>