<?php $__env->startSection('content'); ?>
	<?php $table = str_singular($model->getTable()); ?>
	<a class="btn btn-success" href="<?php echo e(route('admin.'. $table .'.create')); ?>" title="">Create</a>
	<a class="btn btn-success" href="<?php echo e(route('admin.'. $table .'.edit', [$model->id])); ?>" title="">Edit</a>
	
	<?php $routeName = $table .'.show'; ?>
	<?php if(Route::has($routeName)): ?>
		<?php
			$params = [];
			$params[] = $table === 'catalog' ? $model->slug : $model->id;
		?>
		<a class="btn btn-success" href="<?php echo e(route($routeName, $params)); ?>" title="">Show</a>
	<?php endif; ?>

	<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
		<thead>
			<tr>
				<th>Column</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($model->getAttributes() as $column => $value): ?>
				<tr>
					<td><?php echo e($column); ?></td><td><?php echo e($value); ?></td>
				</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>