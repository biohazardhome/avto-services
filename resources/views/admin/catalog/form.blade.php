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
	<label>Тип услуги</label>
	<select name="service_id">
		@foreach($services as $service)
			<option value="{{ $service->id }}" {{ (isset($item->service_id) && $service->id === $item->service_id) ? 'selected' : '' }}>{{ $service->name }}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	<label>
		<span>Address: (Область, город, улица, дом) </span>
	</label>
	<div class="col-sm-10">
		<input class="form-control" type="text" name="address" value="{{ object_get($item, 'address', '') }}" placeholder="Адрес">
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

<br>

<div class="form-group">
	<label>
		<span>City: </span>
		<?php
			$params = ['cities' => $cities];
			if ($type === 'edit') $params['selectedId'] = $item->city->id;
		?>
		@include('partials.city-select', $params)
	</label>
</div>

@if($type === 'create')
	<div class="form-group">
		<label>
			<span>Images: </span>
			@include('image.button')
		</label>
	</div>
@endif

<div class="form-group">
	<label>
		<span>Marks: </span>
	</label>

	@if ($type === 'edit')
		<?php $selectMarks = $item->marks ? $item->marks->pluck('id')->toArray() : []; ?>
	@endif
	<select name="marks[]" multiple="multiple">
		@foreach($marks as $mark)
			<?php $selected = '';
			if ($type === 'edit' && in_array($mark->id, $selectMarks)) {
				$selected = 'selected';
			}?>
			<option value="{{ $mark->id }}" {{ $selected }}>{{ $mark->name }}</option>
		@endforeach
	</select>
	<span>Выбрано: {{ count($selectMarks) }} элементов</span>

</div>

<div class="form-group">
	<label>
		<span>Phones: </span>
		<input class="form-control" type="text" name="phones" value="{{ object_get($item, 'phones', '') }}" placeholder="Phones">
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
		<span>example.com</span>
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