@if($catalog->count())
	<style>
	    #map-all {
	        width: 100%;
	        height: 400px;
	    }
	</style>

	@if ($city)
		<h2 class="text-center">Автосервисы в {{ $city->name }} на карте <span class="lead text-muted">({{ $catalog->count() }}) автосервиса</span></h2>
	@else
		<h2 class="text-center">Все автосервисы на карте <span class="lead text-muted">({{ $catalog->count() }}) автосервиса</span></h2>
	@endif
	@include('partials.map-all', ['catalog' => $catalog])
@endif