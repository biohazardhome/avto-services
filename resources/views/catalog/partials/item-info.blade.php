<div class="catalog-item-info">
	<span><b>{{ $phones }}</b></span>
	@if ($site)
		<a href="{{ $site }}" title="Сайт автосервиса {{ $name }}" rel="nofollow" target="_blank">{{ $site }}</a>
	@endif
	@if ($email)
		<a href="mailto://{{ $email }}">{{ $email }}</a></span>
	@endif
</div>