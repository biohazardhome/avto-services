@extends('layouts.admin')

@section('assetsJS')
	@include('admin.catalog.kladr')
	<script src="/js/upload.js" type="text/javascript"></script>
@stop

@section('content')

	<?php
		$imagesModel = $item->images;
		$images = new My\Service\ImageCollection($imagesModel);
	?>
	<ul>
		@foreach ($images as $k => $image)
			<?php $imageModel = $imagesModel[$k];?>
			<li>
				<img src="{{ $image->getUrl() }}" alt="" title="" width="100">
				<div>
					<a href="/image/delete/{{ $imageModel->id }}/" onclick="return confirm('Удалить?')">Delete</a>
					<a href="/image/edit/{{ $imageModel->id }}/">Edit</a>
				</div>
			</li>
		@endforeach
	</ul>

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