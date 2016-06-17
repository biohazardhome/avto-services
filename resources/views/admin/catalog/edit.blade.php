@extends('layouts.admin')

@section('assetsJS')
	<script src="/trumbowyg/trumbowyg.min.js" type="text/javascript"></script>
	<script>
		$('.trumbowyg').trumbowyg();
	</script>
@stop

@section('assetsCSS')
	<link rel="stylesheet" type="text/css" href="/trumbowyg/ui/trumbowyg.min.css">
@stop



@if ($errors->count())
	@foreach ($errors->all() as $error)
		{{ $error }}
	@endforeach
@endif

@section('content')
	<form action="{{ route('admin.catalog.update', [$item->id]) }}" method="post">
		{{ csrf_field() }}

		<div class="form-group">
			<label>
				<span>Name: </span>
				<input type="text" name="name" value="{{ $item->name }}" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Phones: </span>
				<input type="text" name="phones" value="{{ $item->phones }}" required placeholder="Phones">
			</label>
		</div>

		<div classs="form-group">
			<label>
				<span>Address: </span>
				<input type="text" name="address" value="{{ $item->address }}" required placeholder="Address">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input type="email" name="email" value="{{ $item->email }}" placeholder="Email">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Site: </span>
				<input type="text" name="site" value="{{ $item->site }}" placeholder="Site">
				<span>http://example.com</span>
			</label>
		</div>

		<textarea class="trumbowyg" name="description" required placeholder="Description">{{ $item->description }}</textarea>
		<textarea class="trumbowyg" name="content"  placeholder="Content">{{ $item->content }}</textarea>

		<div class="form-group">
			<label>
				<span>Sort: </span>
				<input type="number" name="sort" value="{{ $item->sort }}" placeholder="Sort">
			</label>
		</div>

		<button>Send</button>
	</form>
@stop