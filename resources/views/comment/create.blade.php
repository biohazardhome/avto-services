
@if (Session::has('message'))
	<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

@if ($errors->count())
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@endif

<form class="form-comment-create" action="{{ route('comment.store') }}" method="POST">
	{{ csrf_field() }}
	{{ method_field('put') }}
	<input type="hidden" name="catalog_id" value="{{ $catalogId }}">
	
	<div class="row ">
	<div class="form-group col-md-4 col-lg-4">
		<label class="sr-only">Имя</label>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
			<input class="form-control input-sm" type="text" name="name" value="" placeholder="Имя" required>
		</div>
	</div>
	
	<div class="form-group col-md-4 col-lg-4">
		<label class="sr-only">Почта</label>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
			<input class="form-control input-sm" type="email" name="email" value="" placeholder="Почта" required>
		</div>
	</div>

	<div class="form-group col-md-8 col-lg-8">
		<label class="sr-only">Сообщение</label>
		<textarea class="form-control input-sm" name="msg" rows="6" placeholder="Сообщение" required></textarea>
	</div>
	</div>

	<button class="btn btn-default">Отправить</button>

</form>