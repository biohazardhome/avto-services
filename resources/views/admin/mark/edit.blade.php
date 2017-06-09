@extends('layouts.admin')

@include('admin.city.kladr')

@section('content')

	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.mark.update', [$mark->id]) }}" method="post">
		
		@include('admin.mark.form', compact('mark'))

	</form>
@stop