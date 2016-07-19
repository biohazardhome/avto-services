<article class="comment-item">
	<div>
		@if ($comment->name)
			<span>Пользователь <span class="glyphicon glyphicon-user"></span> {{ $comment->name }}</span>
		@endif
		@if ($comment->email)
			<span><span class="glyphicon glyphicon-envelope"></span> {{ $comment->email }}</span>
		@endif
		@if ($comment->created_at)
			<span><span class="glyphicon glyphicon-time"> </span>{{ $comment->created_at }}</span>
		@endif
	</div>
	<div>{{ $comment->msg }}</div>
</article>