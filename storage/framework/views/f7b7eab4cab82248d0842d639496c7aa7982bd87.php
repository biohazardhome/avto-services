<?php if(Session::has('message')): ?>
	<div class="alert alert-info">
		<?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>

<?php if($errors->count()): ?>
	<ul class="alert alert-danger" role="alert">
		<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>