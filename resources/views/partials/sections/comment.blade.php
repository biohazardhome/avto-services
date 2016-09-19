@if($comments->count()) 
	<div class="col-md-12 col-lg-12" style="margin-top: 15px; background-color: white; padding: 15px;">
	    @if($city)
	    	<h2 class="text-center">Отзывы об {{ $service->singularLcFirst }}ах в {{ $city->name }}</h2>
	    @else
	    	<h2 class="text-center">Все отзывы о {{ $service->singularLcFirst }}ах</h2>
	    @endif
	    @include('comment.index', ['comments' => $comments])
	</div>
@endif