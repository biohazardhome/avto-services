@if($catalog->count())
	<style>
	    #map-all {
	        width: 100%;
	        height: 400px;
	    }
	</style>

	<?php $type = decline_number($catalog->count(), ['автосервис', 'автосервиса', 'автосервисов']); ?>
	@if ($city)
		<h2 class="text-center">Автосервисы в {{ $city->name }} на карте <span class="lead text-muted">({{ $catalog->count() }}) {{ $type }}</span></h2>
	@else
		<h2 class="text-center">Все автосервисы на карте <span class="lead text-muted">({{ $catalog->count() }}) {{ $type }}</span></h2>
	@endif
	@include('partials.map-all', ['catalog' => $catalog])

	@if ($city)
		<a href="/map/{{ $city->slug }}/">Все {{ $service->name }} в {{ $city->name }} на карте</a>
	@else
		<a href="/map/">Все {{ $service->nameLcFirst }} на карте</a>
	@endif
@endif