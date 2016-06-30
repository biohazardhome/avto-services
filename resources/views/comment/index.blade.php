@foreach($comments as $comment)
	@include('comment.show', compact('comment'))
@endforeach
