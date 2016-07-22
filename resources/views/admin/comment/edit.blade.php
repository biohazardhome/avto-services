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

	<form action="{{ route('admin.comment.update', [$comment->id]) }}" method="post">
		{{ csrf_field() }}

		<div class="form-group">
			<label>
				<span>Catalog ID: </span>
				<input type="number" name="catalog_id" value="{{ $comment->catalog_id }}" required placeholder="Catalog ID">
			</label>
		</div>

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input type="text" name="name" value="{{ $comment->name }}" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input type="email" name="email" value="{{ $comment->email }}" placeholder="Email">
			</label>
		</div>

		<textarea class="trumbowyg" name="msg" required placeholder="Message">{{ $comment->msg }}</textarea>

		<button>Send</button>
	</form>
@stop