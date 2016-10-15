<?php $required = !isset($required) ? true : $required; // по умолчанию required ?>

<select class="form-control" name="city_id" <?php echo e($required ? 'required' : ''); ?>>
	<?php foreach($cities as $city): ?>
		<?php $selected = isset($selectedId) && $selectedId > 0 && $city->id === $selectedId ? 'selected' : ''; ?>
		
		<option value="<?php echo e($city->id); ?>" <?php echo e($selected); ?>><?php echo e($city->name); ?></option>
	<?php endforeach; ?>
</select>