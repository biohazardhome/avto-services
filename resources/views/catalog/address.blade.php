@extends('layouts.index')

@section('title', '')
@section('description', '')

@section('content')
	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		@if ($catalog->count())
			<?php
				$parameters = Route::getCurrentRoute()->parameters();
				if ($parameters) {
					$addressType = key($parameters);
					$addressValue = $parameters[$addressType];
				}
/*				$segments = request()->segments();
				$addressType = $segments[2] ?? null;
				$addressValue = $segments[3] ?? null;
				$addressValue = urldecode($addressValue);
*/				$address = '';

				if ($addressType === 'street') {
					$address = 'на улице '. $addressValue;
				} else if ($addressType === 'region') {
					$address = 'в регионе '. $addressValue;
				} else if ($addressType === 'district') {
					$address = 'в районе '. $addressValue;
				}/* else if ($addressType === 'city') {
					$address = 'в городе '. $catalog->first()->city->name;
				}*/ else if ($addressType === 'build') {
					$address = 'в доме '. $addressValue;
				}
			?>
			<h1 class="text-center">{{ $catalog->first()->service->name }} {{ $address }}</h1>
		@endif

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			@include('catalog.item', compact('item'))
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


