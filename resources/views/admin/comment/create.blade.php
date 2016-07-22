@extends('layouts.admin')

@section('assetsJS')
	<script src="/trumbowyg/trumbowyg.min.js" type="text/javascript"></script>
	<script>
		$('.trumbowyg').trumbowyg();
	</script>
@stop

@section('assetsCSS')
	<link rel="stylesheet" type="text/css" href="/trumbowyg/ui/trumbowyg.min.css">
@stop

@section('content')
	
	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.comment.store') }}" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">

		<div class="form-group">
			<label>
				<span>Catalog ID: </span>
				<input type="number" name="catalog_id" value="" required placeholder="Catalog ID">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input type="text" name="name" value="" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input type="email" name="email" value="" placeholder="Email">
			</label>
		</div>

		<textarea class="trumbowyg" name="msg" required placeholder="Description"></textarea>

		<button>Send</button>
	</form>
@stop