<?php $city = isset($city) ? $city : new stdClass; ?>

<?php echo e(csrf_field()); ?>


<div class="form-group">
	<label>
		<span>Name: </span>
		<input class="form-control" type="text" name="name" value="<?php echo e(object_get($city, 'name', '')); ?>" required placeholder="Name">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Slug: </span>
		<input class="form-control" type="text" name="slug" value="<?php echo e(object_get($city, 'slug', '')); ?>" required placeholder="Slug">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Tile: </span>
		<input class="form-control" type="text" name="title" value="<?php echo e(object_get($city, 'title', '')); ?>" required placeholder="Title">
	</label>
</div>

<div class="form-group">
	<label>
		<span>Description: </span>
		<input class="form-control" type="text" name="description" value="<?php echo e(object_get($city, 'description', '')); ?>" required placeholder="Description">
	</label>
</div>

<div class="form-group">
	<textarea class="trumbowyg" name="text" placeholder="Text"><?php echo e(object_get($city, 'text', '')); ?></textarea>
</div>

<button class="btn btn-default">Send</button>