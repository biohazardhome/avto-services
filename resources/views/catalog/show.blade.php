@extends('layouts.index')

@section('title', $catalog->name)
@section('description', $catalog->description)

@section('content')
	<section>
		<article>
			<h1>{{ $catalog->name }}</h1>
			<address>{{ $catalog->address }}</address>
			<div class="catalog-description">{{ $catalog->description }}</div>
			<div class="catalog-info">
				<span><b>{{ $catalog->phones }}</b></span>
				<a href="{{ $catalog->site }}">{{ $catalog->site }}</a>
				<a href="mailto://{{ $catalog->email }}">{{ $catalog->email }}</a></span>
			</div>
			<div class="catalog-content">{!! $catalog->content !!}</div>
			<div class="catalog-map"></div>
			<div class="catalog-comment"></div>
		</article>
	</section>
@endsection

@section('sidebar')
	<div class="catalog-similar">
		@inject('catalog', 'App\Catalog')
		
		<ul class="catalog-list-similar">
		@foreach($catalog->random(5) as $item)
			<li>
				<article>
					<h1><a href="{{ route('catalog.show', [$item->slug]) }}">{{ $item->name }}</a></h1>
					<div>{{ $item->description }}</div>
				</article>
			</li>
		@endforeach
		</ul>
	</div>
@endsection
