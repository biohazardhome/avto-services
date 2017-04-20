@extends('layouts.admin')

@section('assetsJS')
	@include('admin.catalog.kladr')
	<script src="/js/upload.js" type="text/javascript"></script>
@stop

@section('content')

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