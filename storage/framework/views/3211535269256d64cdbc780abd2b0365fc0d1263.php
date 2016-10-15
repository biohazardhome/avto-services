<?php if(isset($columns) && $columns): ?>

	<?php
		$sortableField = session('sortableField-'. $table);
		$sortableType = session('sortableType-'. $table);
	?>

	<form class="form-inline" action="<?php echo e(route('admin.'. $table .'.index')); ?>" method="post">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
		<label>Sort Field: </label>
			<select class="form-control" name="sortField">
				<?php foreach($columns as $column): ?>
					<?php $selected = $column === $sortableField ? 'selected' : ''; ?>
					<option value="<?php echo e($column); ?>" <?php echo e($selected); ?>><?php echo e(ucfirst($column)); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label>Sort Type</label>
			<select class="form-control" name="sortType">
				<option value="asc" <?php echo e($sortableType === 'asc' ? 'selected' : ''); ?>>ASC</option>
				<option value="desc" <?php echo e($sortableType === 'desc' ? 'selected' : ''); ?>>DESC</option>
			</select>
		</div>

		<button class="btn btn-default">Send</button>
	</form>
<?php endif; ?>