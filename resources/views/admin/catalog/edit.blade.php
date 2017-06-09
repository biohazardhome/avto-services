@extends('layouts.admin')

@section('assetsJS')
	@include('admin.catalog.kladr')
	<link rel="stylesheet" type="text/css" href="/tokenize2/tokenize2.min.css">

	<script src="/js/upload.js" type="text/javascript"></script>
	<script src="/tokenize2/tokenize2.min.js" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			$("select[name='marks[]']").tokenize2();
		});
	</script>
@stop

@section('content')

	{{-- <input type="text" name="test" value=""> --}}

	<?php
		$images = new My\Service\ImageCollection($item->images);
	?>
	@include('image.list-vertical', compact('images'))

	@include('image.upload', [
	    'filename' => $item->slug,
		'folder' => 'catalog/'. $item->slug,
		'imageable_type' => 'catalog',
		'imageable_id' => $item->id]
	)
	<br><br>

	

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.catalog.update', [$item->id]) }}" method="post">

		@include('admin.catalog.form', compact('item', 'cities') + ['type' => 'edit'])

	</form>
@stop