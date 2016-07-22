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

		<button>Send</button>
	</form>
@stop