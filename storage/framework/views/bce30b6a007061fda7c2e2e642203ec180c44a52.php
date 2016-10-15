<?php $__env->startSection('assetsJS'); ?>
	<?php echo $__env->make('admin.catalog.kladr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script src="/js/upload.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<?php
		$imagesModel = $item->images;
		$images = new My\Service\ImageCollection($imagesModel);
	?>
	<ul>
		<?php foreach($images as $k => $image): ?>
			<?php $imageModel = $imagesModel[$k];?>
			<li>
				<img src="<?php echo e($image->getUrl()); ?>" alt="" title="" width="100">
				<div>
					<a href="/image/delete/<?php echo e($imageModel->id); ?>/" onclick="return confirm('Удалить?')">Delete</a>
					<a href="/image/edit/<?php echo e($imageModel->id); ?>/">Edit</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $__env->make('image.upload', [
	    'filename' => $item->slug,
		'folder' => 'catalog/'. $item->slug,
		'imageable_type' => 'catalog',
		'imageable_id' => $item->id]
	, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br><br>

	

	<?php echo $__env->make('partials.form.errors', compact('errors'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<form action="<?php echo e(route('admin.catalog.update', [$item->id])); ?>" method="post">

		<?php echo $__env->make('admin.catalog.form', compact('item', 'cities') + ['type' => 'edit'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>