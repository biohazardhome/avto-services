<?php $required = !isset($required) ? true : $required; // по умолчанию required ?>

<select class="form-control" name="city_id" {{ $required ? 'required' : '' }}>
	@foreach ($cities as $city)
		<?php $selected = isset($selectedId) && $selectedId > 0 && $city->id === $selectedId ? 'selected' : ''; ?>
		
		<option value="{{ $city->id }}" {{ $selected }}>{{ $city->name }}</option>
	@endforeach
</select>