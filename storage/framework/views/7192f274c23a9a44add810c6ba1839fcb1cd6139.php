<?php echo $__env->make('admin.city.kladr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('partials.form.errors', compact('errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<form action="<?php echo e(route('admin.city.update', [$city->id])); ?>" method="post">
		
		<?php echo $__env->make('admin.city.form', compact('city'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- <?php echo e(csrf_field()); ?>

		
		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="<?php echo e($city->name); ?>" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Slug: </span>
				<input class="form-control" type="text" name="slug" value="<?php echo e($city->slug); ?>" required placeholder="Slug">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Tile: </span>
				<input class="form-control" type="text" name="title" value="<?php echo e($city->title); ?>" required placeholder="Title">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Description: </span>
				<input class="form-control" type="text" name="description" value="<?php echo e($city->description); ?>" required placeholder="Description">
			</label>
		</div>
		
		<div class="form-group">
			<textarea class="trumbowyg" name="text" placeholder="Text"><?php echo e($city->text); ?></textarea>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>