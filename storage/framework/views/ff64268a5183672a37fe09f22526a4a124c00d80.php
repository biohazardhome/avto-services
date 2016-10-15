
<form id="form-image-upload" action="/image/upload/" method="POST" enctype="multipart/form-data">
	<?php /* <?php echo e(csrf_field()); ?> */ ?>
	<input type="hidden" name="folder" value="<?php echo e(!empty($folder) ? $folder : ''); ?>"></input>
	<input type="hidden" name="imageable_type" value="<?php echo e(!empty($imageable_type) ? $imageable_type : ''); ?>"></input>
	<input type="hidden" name="imageable_id" value="<?php echo e(!empty($imageable_id) ? $imageable_id : ''); ?>"></input>
	<?php echo $__env->make('image.button', ['required' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<input type="text" name="filename" value="<?php echo e(!empty($filename) ? $filename : ''); ?>">
	<input type="text" name="alt" value="">
	<input type="text" name="title" value="">
	<button type="submit">Upload</button>
</form>
<div class="images-preview"></div>

