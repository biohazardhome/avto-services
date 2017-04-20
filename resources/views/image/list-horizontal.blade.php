<ul>
	@foreach ($images as $image)
		<?php $imageModel = $image->getModel(); ?>
		<li>
			<img src="{{ $image->getUrl() }}" alt="" title="" width="100">
		</li>
	@endforeach
</ul>