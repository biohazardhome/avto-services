<?php
	$type = isset($type) ? $type : 'create';
	$item = isset($item) ? $item : new stdClass;
?>

{{ csrf_field() }}

<div class="form-group">
	<label>
		<span>Name: </span>
		<input class="form-control" type="text" name="name" value="{{ object_get($item, 'name', '') }}" required placeholder="Name">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Address: </span>
	</label>
	<div class="col-sm-10">
		<input class="form-control" name="address" type="text" value="{{ object_get($item, 'address', '') }}" placeholder="Адрес">
	</div>
</div>

@if($type === 'edit') 
	<div class="form-group">
		<label>
			<span>Regenerate Slug: value ({{ object_get($item, 'slug', '') }})</span>
			<input type="checkbox" name="regenerateSlug" value="1" {{ $item->getSlugOptions()->regenerateOnUpdate ? 'checked' : '' }} placeholder="Regenerate Slug">
		</label>
	</div>
@endif

<div class="form-group">
	<label>
		<span>City: </span>
		<?php
			$params = ['cities' => $cities];
			if ($type === 'edit') $params[] = ['selectedId' => $item->city->first()->id];
		?>
		@include('partials.city-select', $params)
	</label>
</div>

<div class="form-group">
	<label>
		<span>Phones: </span>
		<input class="form-control" type="text" name="phones" value="{{ object_get($item, 'phones', '') }}" required placeholder="Phones">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Email:</span> 
		<input class="form-control" type="email" name="email" value="{{ object_get($item, 'email', '') }}" placeholder="Email">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Site: </span>
		<input class="form-control" type="text" name="site" value="{{ object_get($item, 'site', '') }}" placeholder="Site">
		<span>http://example.com</span>
	</label>
</div>

<textarea class="trumbowyg" name="description" required placeholder="Description">{{ object_get($item, 'description', '') }}</textarea>
<textarea class="trumbowyg" name="content"  placeholder="Content">{{ object_get($item, 'content', '') }}</textarea>

<div class="form-group">
	<label>
		<span>Sort: </span>
		<input class="form-control" type="number" name="sort" value="{{ object_get($item, 'sort', '') }}" placeholder="Sort">
	</label>
</div>

<button class="btn btn-default">Send</button>