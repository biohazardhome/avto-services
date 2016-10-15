<section class="comments">
	@foreach($comments as $comment)
		@include('comment.show', compact('comment'))
	@endforeach
</section>

