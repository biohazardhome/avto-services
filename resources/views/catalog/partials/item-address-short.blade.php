<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="{{ route('map.show', [$item->slug, $item->address]) }}" title="Узнать расположение автосервиса {{ $item->name }} на карте">
		<a href="/address/region/{{ $item->addressRegion }}/" title="">{{ $item->addressRegion }}</a>, 
		<a href="/{{$item->city->slug}}/" title="">{{ $item->addressCityShort }}</a>, 
		<a href="/address/street/{{ $item->addressStreet }}/" title="">{{ $item->addressStreet }}</a>, 
		<a href="/address/build/{{ $item->addressBuilding }}/" title="">{{ $item->addressBuilding }}</a>
	</a>
</address>