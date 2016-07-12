<div class="catalog-item-info">
	<ul class="list-unstyled">
		<li class="catalog-item-phones">
			<span class="glyphicon glyphicon-phone-alt"></span>
			<span><b>{{ $phones }}</b></span>
		</li>
		@if ($site)
			<li>
				<span class="glyphicon glyphicon-globe"></span>
				<a href="{{ $site }}" title="Сайт автосервиса {{ $name }}" rel="nofollow" target="_blank">{{ str_replace('www.', '', $site) }}</a>
			</li>
		@endif
		@if ($email)
			<div>
				<span class="glyphicon glyphicon-envelope"></span>
				<a href="mailto:{{ $email }}">{{ $email }}</a></span>
			</div>
		@endif
	</ul>
</div>