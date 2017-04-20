<ul class="list-unstyled">
	@foreach ($images as $image)
	<?php $imageModel = $image->getModel(); ?>
		<li>
			<img src="{{ $image->getUrl() }}" alt="" title="" width="100">
			<div>
				<a href="/image/delete/{{ $imageModel->id }}/" onclick="return confirm('Удалить?')">Delete</a>
				<a href="/image/edit/{{ $imageModel->id }}/">Edit</a>
			</div>
		</li>
	@endforeach
</ul>