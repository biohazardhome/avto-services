<?php if($comments->count()): ?> 
	<div class="col-md-12 col-lg-12" style="margin-top: 15px; background-color: white; padding: 15px;">
	    <?php if($city): ?>
	    	<h2 class="text-center">Отзывы об <?php echo e($service->singularLcFirst); ?>ах в <?php echo e($city->name); ?></h2>
	    <?php else: ?>
	    	<h2 class="text-center">Все отзывы о <?php echo e($service->singularLcFirst); ?>ах</h2>
	    <?php endif; ?>
	    <?php echo $__env->make('comment.index', ['comments' => $comments], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
<?php endif; ?>