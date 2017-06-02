<ul class="list-unstyled list-inline">
	@foreach ($images as $key=>$image)
		<?php
			$imageModel = $image->getModel();
			$imgUrl = str_replace('/upload', '', $image->getUrl());
			
			$title = '';
			if (isset($service) && isset($city)) {
				$title = 'фото '. $service->singular .' '. $catalog->name .' в '. $city->name .' '. ($key+1);
			}
		?>
		<li>
			<a href="{{ $imgUrl }}" title="Просмотреть {{ $title }}" target="_blank">
				<img src="{{ $imgUrl }}" alt="{{ $title }}" title="Просмотреть {{ $title }}" width="100">
			</a>
		</li>
	@endforeach
</ul>
