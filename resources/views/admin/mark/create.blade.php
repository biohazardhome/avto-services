@extends('layouts.admin')

@include('admin.city.kladr')

@section('content')
	
	@include('partials.form.errors', compact('errors'))

	<form action="{{ route('admin.mark.store') }}" method="post">

		{{ method_field('PUT') }}

		@include('admin.mark.form')
		
	</form>
@stop