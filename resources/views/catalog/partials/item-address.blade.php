<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="{{ route('map.show', [$slug, $address]) }}" title="Узнать расположение автосервиса {{ $name }} на карте">{{ $address }}</a>
</address>