@extends('layouts.admin')

@section('title', 'Comment list')

@section('content')

	@include('admin.searchable', compact('table'))
	@include('admin.sortable', compact('table', 'columns'))

	<a class="btn btn-success" href="{{ route('admin.'. $table .'.create') }}" title="">Create</a>
	
	{!! $content !!}
@stop