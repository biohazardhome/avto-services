<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="{{ route('map.show', [$item->slug, $item->address]) }}" title="Узнать расположение автосервиса {{ $item->name }} на карте">
		{{ $item->addressRegion }}, {{ $item->addressCityShort }}, {{ $item->addressStreet }}, {{ $item->addressBuilding }}
	</a>
</address>