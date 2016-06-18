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



@if ($errors->count())
	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach
@endif

@section('content')
	<form action="{{ route('admin.catalog.store') }}" method="post">
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
				<span>Phones: </span>
				<input type="text" name="phones" value="" required placeholder="Phones">
			</label>
		</div>

		<div classs="form-group">
			<label>
				<span>Address: </span>
				<input type="text" name="address" value="" required placeholder="Address">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input type="email" name="email" value="" placeholder="Email">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Site: </span>
				<input type="text" name="site" value="" placeholder="Site">
				<span>http://example.com</span>
			</label>
		</div>

		<textarea class="trumbowyg" name="description" required placeholder="Description"></textarea>
		<textarea class="trumbowyg" name="content"  placeholder="Content"></textarea>

		<div class="form-group">
			<label>
				<span>Sort: </span>
				<input type="number" name="sort" value="" placeholder="Sort">
			</label>
		</div>

		<button>Send</button>
	</form>
@stop