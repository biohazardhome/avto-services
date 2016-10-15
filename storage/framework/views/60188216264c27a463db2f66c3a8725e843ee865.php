<form action="<?php echo e(route('admin.'. $table .'.index')); ?>" method="post" role="search">
	<?php echo e(csrf_field()); ?>

	<div class="form-group">
		<input class="form-control" type="text" name="query" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-default">Отправить</button>
</form>