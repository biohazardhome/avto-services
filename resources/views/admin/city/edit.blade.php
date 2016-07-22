@extends('layouts.admin')

@section('content')

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.city.update', [$city->id]) }}" method="post">
		{{ csrf_field() }}

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input type="text" name="name" value="{{ $city->name }}" required placeholder="Name">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Slug: </span>
				<input type="text" name="slug" value="{{ $city->slug }}" required placeholder="Slug">
			</label>
		</div>
		
		<button>Send</button>
	</form>
@stop