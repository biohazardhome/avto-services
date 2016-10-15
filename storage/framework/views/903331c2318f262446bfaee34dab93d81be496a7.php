<?php $__env->startSection('assetsJS'); ?>
	<?php echo $__env->make('admin.catalog.kladr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php echo $__env->make('partials.form.errors', compact('errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<form action="<?php echo e(route('admin.catalog.store')); ?>" method="post" enctype="multipart/form-data">
		<?php /* <input type="hidden" name="_method" value="PUT"> */ ?>

		<?php echo $__env->make('admin.catalog.form', compact('cities'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<!-- <?php echo e(csrf_field()); ?>

		
		<div class="form-group">
			<label>
				<span>Name: </span>
				<input class="form-control" type="text" name="name" value="" required placeholder="Name">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Address: </span>
			</label>
			<div class="col-sm-10">
				<input class="form-control" name="address" type="text" value="" placeholder="Адрес">
			</div>
		</div>
		
		<div class="form-group">
			<label>
				<span>City: </span>
				<?php echo $__env->make('partials.city-select', compact('cities'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Phones: </span>
				<input class="form-control" type="text" name="phones" value="" required placeholder="Phones">
			</label>
		</div>
		
		<div classs="form-group">
			<label>
				<span>Address: </span>
				<input class="form-control" type="text" name="address" value="" required placeholder="Address">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Email:</span> 
				<input class="form-control" type="email" name="email" value="" placeholder="Email">
			</label>
		</div>
		
		<div class="form-group">
			<label>
				<span>Site: </span>
				<input class="form-control" type="text" name="site" value="" placeholder="Site">
				<span>http://example.com</span>
			</label>
		</div>
		
		<textarea class="trumbowyg" name="description" required placeholder="Description"></textarea>
		<textarea class="trumbowyg" name="content"  placeholder="Content"></textarea>
		
		<div class="form-group">
			<label>
				<span>Sort: </span>
				<input class="form-control" type="number" name="sort" value="" placeholder="Sort">
			</label>
		</div>
		
		<button class="btn btn-default">Send</button> -->
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>