<article class="comment-item">
	<div>
		<?php if($comment->catalog): ?>
			<a href="<?php echo e(route('catalog.show', $comment->catalog->slug)); ?>"><?php echo e($comment->catalog->name); ?></a>
		<?php endif; ?>
		<?php if($comment->name): ?>
			<span>Пользователь <span class="glyphicon glyphicon-user"></span> <?php echo e($comment->name); ?></span>
		<?php endif; ?>
		<?php if($comment->email): ?>
			<span><span class="glyphicon glyphicon-envelope"></span> <?php echo e($comment->email); ?></span>
		<?php endif; ?>
		<?php if($comment->created_at): ?>
			<span><span class="glyphicon glyphicon-time"> </span><?php echo e($comment->created_at); ?></span>
		<?php endif; ?>
	</div>
	<div><?php echo e($comment->msg); ?></div>
</article>