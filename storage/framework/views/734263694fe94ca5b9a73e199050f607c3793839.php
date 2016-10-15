<?php $__env->startSection('title', 'Comment list'); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('admin.searchable', compact('table'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('admin.sortable', compact('table', 'columns'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<a class="btn btn-success" href="<?php echo e(route('admin.'. $table .'.create')); ?>" title="">Create</a>
	
	<?php echo $content; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>