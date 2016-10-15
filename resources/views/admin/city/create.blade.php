@extends('layouts.admin')

@include('admin.city.kladr')

@section('content')
	
	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.city.store') }}" method="post">

		@include('admin.city.form')

		<!-- {{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">
		
		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Slug: </span>
				<input class="form-control" type="text" name="slug" value="" required placeholder="Slug">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Tile: </span>
				<input class="form-control" type="text" name="title" value="" placeholder="Title">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Description: </span>
				<input class="form-control" type="text" name="description" value="" placeholder="Description">
			</label>
		</div>
		
		<div class="form-group">
			<textarea class="trumbowyg" name="text" placeholder="Text"></textarea>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
@stop