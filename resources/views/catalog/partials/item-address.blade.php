<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="{{ route('map.show', [$name, $address]) }}" title="Узнать расположение автосервиса {{ $name }} на карте" target="_blank">{{ $address }}</a>
</address>