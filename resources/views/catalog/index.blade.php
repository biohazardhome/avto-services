@extends('layouts.index')

@section('title', 'Fdnjcthdbcs d Jlbywjdj')

@section('content')
	<section class="catalog-list">
		@foreach($catalog as $item)
			<article class="catalog-list-item">
				<h1><a href="{{ route('catalog.show', [$item->slug]) }}" title=" {{ $item->name }}">{{ $item->name }}</a></h1>
				<address><a href="/map/{{ $item->address }}">{{ $item->address }}</a></address>
				<div class="catalog-list-item-content">
					{{ $item->description }}
				</div>
				<div class="catalog-list-item-info">
					<span><b>{{ $item->phones }}</b></span>
					<a href="{{ $item->site }}">{{ $item->site }}</a>
					<a href="mailto://{{ $item->email }}">{{ $item->email }}</a></span>
				</div>
			</article>
		@endforeach
	</section>
	
	{{ $catalog->links() }}
@endsection

@section('sidebar')
	<h1></h1>
@endsection
