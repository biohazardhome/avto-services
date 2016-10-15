<?php
	$type = isset($type) ? $type : 'create';
	$item = isset($item) ? $item : new stdClass;
?>

<?php echo e(csrf_field()); ?>


<div class="form-group">
	<label>
		<span>Name: </span>
		<input class="form-control" type="text" name="name" value="<?php echo e(object_get($item, 'name', '')); ?>" required placeholder="Name">
	</label>
</div>

<div class="form-group">
	<label>Тип услуги</label>
	<select name="service_id">
		<?php foreach($services as $service): ?>
			<option value="<?php echo e($service->id); ?>" <?php echo e((isset($item->service_id) && $service->id === $item->service_id) ? 'selected' : ''); ?>><?php echo e($service->name); ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="form-group">
	<label>
		<span>Address: (Область, город, улица, дом) </span>
	</label>
	<div class="col-sm-10">
		<input class="form-control" type="text" name="address" value="<?php echo e(object_get($item, 'address', '')); ?>" placeholder="Адрес">
	</div>
</div>

<?php if($type === 'edit'): ?> 
	<div class="form-group">
		<label>
			<span>Regenerate Slug: value (<?php echo e(object_get($item, 'slug', '')); ?>)</span>
			<input type="checkbox" name="regenerateSlug" value="1" <?php echo e($item->getSlugOptions()->regenerateOnUpdate ? 'checked' : ''); ?> placeholder="Regenerate Slug">
		</label>
	</div>
<?php endif; ?>

<div class="form-group">
	<label>
		<span>City: </span>
		<?php
			$params = ['cities' => $cities];
			if ($type === 'edit') $params['selectedId'] = $item->city->id;
		?>
		<?php echo $__env->make('partials.city-select', $params, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</label>
</div>

<?php if($type === 'create'): ?>
	<div class="form-group">
		<label>
			<span>Images: </span>
			<?php echo $__env->make('image.button', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</label>
	</div>
<?php endif; ?>

<div class="form-group">
	<label>
		<span>Phones: </span>
		<input class="form-control" type="text" name="phones" value="<?php echo e(object_get($item, 'phones', '')); ?>" placeholder="Phones">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Email:</span> 
		<input class="form-control" type="email" name="email" value="<?php echo e(object_get($item, 'email', '')); ?>" placeholder="Email">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Site: </span>
		<input class="form-control" type="text" name="site" value="<?php echo e(object_get($item, 'site', '')); ?>" placeholder="Site">
		<span>example.com</span>
	</label>
</div>

<textarea class="trumbowyg" name="description" required placeholder="Description"><?php echo e(object_get($item, 'description', '')); ?></textarea>
<textarea class="trumbowyg" name="content"  placeholder="Content"><?php echo e(object_get($item, 'content', '')); ?></textarea>

<div class="form-group">
	<label>
		<span>Sort: </span>
		<input class="form-control" type="number" name="sort" value="<?php echo e(object_get($item, 'sort', '')); ?>" placeholder="Sort">
	</label>
</div>

<button class="btn btn-default">Send</button>