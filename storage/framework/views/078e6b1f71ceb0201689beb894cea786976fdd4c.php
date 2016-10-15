<?php $__env->startSection('title', ''); ?>
<?php $__env->startSection('description', 'Автосервисы в- каталог адресов и телефонов автосервисов в  с полной справочной информацией и отзывами'); ?> <!-- полная справочная информация, схема проезда-->


<?php $__env->startSection('head'); ?>
	<link rel="canonical" href="<?php echo e(route('catalog.index')); ?>/" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		
		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add($service->name, '/'. $service->slug);
		?>

		<?php echo Breadcrumbs::render(); ?>


		<h1 class="text-center"><?php echo e($service->name); ?></h1>

		<p><?php echo $service->content; ?></p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;"><?php echo e($catalog->links()); ?></div>

		<?php foreach($catalog as $item): ?>
			<?php echo $__env->make('catalog.item', compact('item', 'service'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; ?>
	
		<div class="text-center"><?php echo e($catalog->links()); ?></div>
	</section>
	
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>