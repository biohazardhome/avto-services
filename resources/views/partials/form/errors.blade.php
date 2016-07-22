@if (Session::has('message'))
	<div class="alert alert-info">
		{{ Session::get('message') }}
	</div>
@endif

@if ($errors->count())
	<ul class="alert alert-danger" role="alert">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@endif