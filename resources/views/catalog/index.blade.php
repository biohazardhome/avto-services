@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово - адреса и телефоны')
@section('description', 'Автосервисы в Одинцово - каталог адресов и телефонов автосервисов в Одинцово с полной справочной информацией и отзывами') <!-- полная справочная информация, схема проезда-->

@section('content')
	

	<section class="catalog-list col-md-9 col-lg-9">
		<h1 class="text-center">Автосервисы в Одинцово</h1>

		<p>
			У вас поломался автомобиль и срочно нужен автосервис в Одинцово? Наш каталог автосервисов в Одинцово поможет найти ближайший подходящий сервис для вас и вашей машины. Так же вы можете получить полную информацию о автосервисе, от адреса и телефона, до расположения на карте.
		</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			<article class="catalog-item">
				@include('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']))
				@include('catalog.partials.item-address', $item->getAttributesOnly(['name', 'address']))
				<div class="catalog-item-content" title="Подробнее об автосервисе {{ $item->name }}">
					{!! $item->description !!}
				</div>
				@include('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']))
				<a href="#" title="Отзывы о автосервисе {{ $item->name }}">Отзывы</a>
			</article>
		@endforeach
	
		<div class="text-center">{{ $catalog->links() }}</div>
	</section>
	
@stop


