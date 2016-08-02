@extends('layouts.admin')

@include('admin.catalog.kladr')

@section('content')

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.catalog.update', [$item->id]) }}" method="post">

		@include('admin.catalog.form', compact('item', 'cities') + ['type' => 'edit'])

		<!-- {{ csrf_field() }}

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="{{ $item->name }}" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Address: </span>
			</label>
			<div class="col-sm-10">
				<input class="form-control" name="address" type="text" value="{{ $item->address }}" placeholder="Адрес">
			</div>
		</div>
		
		<div class="form-group">
			<label>
				<span>Regenerate Slug: value ({{ $item->slug }})</span>
				<input type="checkbox" name="regenerateSlug" value="1" {{ $item->getSlugOptions()->regenerateOnUpdate ? 'checked' : '' }} placeholder="Regenerate Slug">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>City: </span>
				@include('partials.city-select', ['cities' => $cities, 'selectedId' => $item->city->first()->id])
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Phones: </span>
				<input class="form-control" type="text" name="phones" value="{{ $item->phones }}" required placeholder="Phones">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input class="form-control" type="email" name="email" value="{{ $item->email }}" placeholder="Email">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Site: </span>
				<input class="form-control" type="text" name="site" value="{{ $item->site }}" placeholder="Site">
				<span>http://example.com</span>
			</label>
		</div>
		
		<textarea class="trumbowyg" name="description" required placeholder="Description">{{ $item->description }}</textarea>
		<textarea class="trumbowyg" name="content"  placeholder="Content">{{ $item->content }}</textarea>
		
		<div class="form-group">
			<label>
				<span>Sort: </span>
				<input class="form-control" type="number" name="sort" value="{{ $item->sort }}" placeholder="Sort">
			</label>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
@stop