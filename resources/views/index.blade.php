@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово - адреса и телефоны автосервисов в Одинцово')
@section('description', 'Автосервисы в Одинцово - каталог адресов и телефонов автосервисов в Одинцово с полной справочной информацией и отзывами') <!-- полная справочная информация, схема проезда-->

@section('content')

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		<h1 class="text-center">Автосервисы в Одинцово</h1>

		<p>У вас поломался автомобиль и срочно нужен автосервис в Одинцово? Наш каталог автосервисов в Одинцово поможет найти ближайший подходящий сервис для вас и вашей машины. Так же вы можете получить полную информацию о интересующем вас автосервисе, от адреса и телефона, до расположения на карте и воспользоваться функционалом поиска автосервиса на карте, обратным звонком в интересующий вас автосервис и подтверждением доступа к редактированию если это ваша компания.</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			<article class="catalog-item">
				@include('catalog.partials.item-header-link-city', $item->getAttributesOnly(['name', 'slug']) + ['city' => $item->city->first()])
				{{-- @include('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address'])) --}}
				@include('catalog.partials.item-address-short-anchor', $item)
				<div class="catalog-item-content" title="Подробнее об автосервисе {{ $item->name }}">
					{!! $item->description !!}
				</div>
				@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))

				<a href="{{ route('catalog.show', [$item->slug]) }}#comments" title="Отзывы о автосервисе {{ $item->name }}">Отзывы ({{ $item->comments_count }})</a>
			</article>
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


