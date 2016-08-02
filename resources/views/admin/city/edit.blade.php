@extends('layouts.admin')

@include('admin.city.kladr')

@section('content')

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.city.update', [$city->id]) }}" method="post">
		
		@include('admin.city.form', compact('city'))

		<!-- {{ csrf_field() }}
		
		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="{{ $city->name }}" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Slug: </span>
				<input class="form-control" type="text" name="slug" value="{{ $city->slug }}" required placeholder="Slug">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Tile: </span>
				<input class="form-control" type="text" name="title" value="{{ $city->title }}" required placeholder="Title">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Description: </span>
				<input class="form-control" type="text" name="description" value="{{ $city->description }}" required placeholder="Description">
			</label>
		</div>
		
		<div class="form-group">
			<textarea class="trumbowyg" name="text" placeholder="Text">{{ $city->text }}</textarea>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
@stop