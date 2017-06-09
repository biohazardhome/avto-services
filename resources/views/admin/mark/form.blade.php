<?php $mark = isset($mark) ? $mark : new stdClass; ?>

{{ csrf_field() }}

<div class="form-group">
	<label>
		<span>Name: </span>
		<input class="form-control" type="text" name="name" value="{{ object_get($mark, 'name', '') }}" required placeholder="Name">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Tile: </span>
		<input class="form-control" type="text" name="title" value="{{ object_get($mark, 'title', '') }}" placeholder="Title">
	</label>
</div>

<div class="form-group">
	<textarea class=" trumbowyg" type="text" name="description" value="{{ object_get($mark, 'description', '') }}" placeholder="Description"></textarea>
</div>

<button class="btn btn-default">Send</button>