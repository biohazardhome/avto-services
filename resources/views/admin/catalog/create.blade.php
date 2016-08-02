@extends('layouts.admin')

@include('admin.catalog.kladr')

@section('content')

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.catalog.store') }}" method="post">
		<input type="hidden" name="_method" value="PUT">

		@include('admin.catalog.form', compact('cities'))

		<!-- {{ csrf_field() }}
		
		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Address: </span>
			</label>
			<div class="col-sm-10">
				<input class="form-control" name="address" type="text" value="" placeholder="Адрес">
			</div>
		</div>
		
		<div class="form-group">
			<label>
				<span>City: </span>
				@include('partials.city-select', compact('cities'))
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Phones: </span>
				<input class="form-control" type="text" name="phones" value="" required placeholder="Phones">
			</label>
		</div>
		
		<div classs="form-group">
			<label>
				<span>Address: </span>
				<input class="form-control" type="text" name="address" value="" required placeholder="Address">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input class="form-control" type="email" name="email" value="" placeholder="Email">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Site: </span>
				<input class="form-control" type="text" name="site" value="" placeholder="Site">
				<span>http://example.com</span>
			</label>
		</div>
		
		<textarea class="trumbowyg" name="description" required placeholder="Description"></textarea>
		<textarea class="trumbowyg" name="content"  placeholder="Content"></textarea>
		
		<div class="form-group">
			<label>
				<span>Sort: </span>
				<input class="form-control" type="number" name="sort" value="" placeholder="Sort">
			</label>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
@stop