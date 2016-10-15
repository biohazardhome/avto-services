@if($catalog->count())

		<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		<script src="/js/map.js" type="text/javascript"></script>
		<script src="/js/map-all.js" type="text/javascript"></script>
		

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
	<div id="map-all"></div>

	@if ($city)
		@section('js')

			<script type="text/javascript">
				$(document).ready(function() {
					var promise = mapCity('{{ $city->slug }}')/*.done(function(data) {
						console.log(data)
					})*/;
				});
			</script>
		@stop
		<a href="/map/{{ $city->slug }}/">Все {{ $service->name }} в {{ $city->name }} на карте</a>
	@else
		<a href="/map/">Все {{ $service->nameLcFirst }} на карте</a>
	@endif
@endif