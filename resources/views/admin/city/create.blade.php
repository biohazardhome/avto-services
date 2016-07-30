@extends('layouts.admin')

@section('content')
	
	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.city.store') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input type="text" name="name" value="" required placeholder="Name">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Slug: </span>
				<input type="text" name="slug" value="" required placeholder="Slug">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Tile: </span>
				<input type="text" name="title" value="" placeholder="Title">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Description: </span>
				<input type="text" name="description" value="" placeholder="Description">
			</label>
		</div>

		<div class="form-group">
			<textarea name="text" placeholder="Text"></textarea>
		</div>

		<button>Send</button>
	</form>
@stop