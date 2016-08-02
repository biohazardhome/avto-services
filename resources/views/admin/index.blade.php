@extends('layouts.admin')

@section('title', 'Comment list')

@section('content')

	@include('admin.searchable', compact('table'))
	@include('admin.sortable', compact('table', 'columns'))
	
	{!! $content !!}
@stop