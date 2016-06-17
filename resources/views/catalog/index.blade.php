@extends('layouts.index')

@section('title', 'Автосервисы в Одинцово - адреса и телефоны')
@section('description', 'Автосервисы в Одинцово - каталог адресов и телефонов всех автосервисов в Одинцово')

@section('content')
	

	<section class="catalog-list">
		<h1>Автосервисы в Одинцово</h1>

		<p class="description">
			У вас поломался автомобиль и срочно нужен автосервис в Одинцово? Наш каталог автосервисов в Одинцово поможет найти ближайший подходящий сервис для вас и вашей машины. Так же вы можете получить полную информацию о автосервисе от адреса и телефона до расположения на карте.
		</p>

		<div style="text-align: center">{{ $catalog->links() }}</div>

		@foreach($catalog as $item)
			<article class="catalog-item catalog-item-border">
				@include('catalog.partials.item-header', $item->getAttributes(['name', 'slug']))
				@include('catalog.partials.item-address', ['address' => $item->address])
				<div class="catalog-item-content" title="Подробнее об автосервисе {{ $item->name }}">
					{!! $item->description !!}
				</div>
				@include('catalog.partials.item-info', $item->getAttributes(['phones', 'site', 'email', 'name']))
				<a href="#" title="Отзывы о автосервисе {{ $item->name }}">Отзывы</a>
			</article>
		@endforeach
	</section>
	
	<div style="text-align: center">{{ $catalog->links() }}</div>
@stop


