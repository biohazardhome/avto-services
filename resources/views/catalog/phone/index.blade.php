@extends('layouts.index')

@section('title', '')
@section('description', '')

@section('content')

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		<h1 class="text-center">Телефоны компаниий</h1>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		<div class="phones">
			@foreach($catalog as $item)
				@include('catalog.phone.partials.phone', compact('item'))
			@endforeach
		</div>
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


