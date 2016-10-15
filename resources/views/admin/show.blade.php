@extends('layouts.admin')

@section('content')
	<?php $table = str_singular($model->getTable()); ?>
	<a class="btn btn-success" href="{{ route('admin.'. $table .'.create') }}" title="">Create</a>
	<a class="btn btn-success" href="{{ route('admin.'. $table .'.edit', [$model->id]) }}" title="">Edit</a>
	
	<?php $routeName = $table .'.show'; ?>
	@if(Route::has($routeName))
		<?php
			$params = [];
			$params[] = $table === 'catalog' ? $model->slug : $model->id;
		?>
		<a class="btn btn-success" href="{{ route($routeName, $params) }}" title="">Show</a>
	@endif

	<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
		<thead>
			<tr>
				<th>Column</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($model->getAttributes() as $column => $value)
				<tr>
					<td>{{ $column }}</td><td>{{ $value }}</td>
				</tr>	
			@endforeach
		</tbody>
	</table>
@stop