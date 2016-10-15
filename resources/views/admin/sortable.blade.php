@if(isset($columns) && $columns)

	<?php
		$sortableField = session('sortableField-'. $table);
		$sortableType = session('sortableType-'. $table);
	?>

	<form class="form-inline" action="{{ route('admin.'. $table .'.index') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
		<label>Sort Field: </label>
			<select class="form-control" name="sortField">
				@foreach($columns as $column)
					<?php $selected = $column === $sortableField ? 'selected' : ''; ?>
					<option value="{{ $column }}" {{ $selected}}>{{ ucfirst($column) }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Sort Type</label>
			<select class="form-control" name="sortType">
				<option value="asc" {{ $sortableType === 'asc' ? 'selected' : '' }}>ASC</option>
				<option value="desc" {{ $sortableType === 'desc' ? 'selected' : '' }}>DESC</option>
			</select>
		</div>

		<button class="btn btn-default">Send</button>
	</form>
@endif