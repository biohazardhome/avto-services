<section class="comments">
	<?php foreach($comments as $comment): ?>
		<?php echo $__env->make('comment.show', compact('comment'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php endforeach; ?>
</section>

