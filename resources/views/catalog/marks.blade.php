

<style type="text/css">
	.marks ul {
		padding-left: 5px;
		display: inline-block;
	}

	.marks ul li {
		padding: 0;
	}

	/* .marks ul li a:after {
		content: ",";
	}
	
	.marks ul li:last-child a:after {
		content: "";
	} */
</style>

@if ($catalog->marks)
	<div class="marks">
		<span title="Работаем с марками автомобилей">Марки:</span> <ul class="list-unstyled list-inline list-separator-comma">

			@foreach($catalog->marks as $mark)
				<li><a href="" title="Ремонтируем автомобили марки {{ $mark->name }}">{{ $mark->name }}</a></li>
			@endforeach

		</ul>
	</div>
@endif