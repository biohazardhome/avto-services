@if($comments->count()) 
	<div class="col-md-12 col-lg-12" style="margin-top: 15px; background-color: white; padding: 15px;">
	    @if($city)
	    	<h2 class="text-center">Отзывы о автосервисах в {{ $city->name }}</h2>
	    @else
	    	<h2 class="text-center">Все отзывы о автосервисах</h2>
	    @endif
	    @include('comment.index', ['comments' => $comments])
	</div>
@endif