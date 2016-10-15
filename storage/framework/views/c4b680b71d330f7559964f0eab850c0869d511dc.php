<?php $__env->startSection('title', 'Автосервисы в '. $city->name .' с отзывами и местоположением на карте'); ?>
<?php $__env->startSection('description', 'Автосервисы в '. $city->name .' - каталог адресов и телефонов автосервисов в '. $city->name .' с полной справочной информацией и отзывами'); ?> <!-- полная справочная информация, схема проезда-->


<?php $__env->startSection('head'); ?>
	<link rel="canonical" href="<?php echo e(route('catalog.index')); ?>/" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		
		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add('Автосервисы', '/');
			Breadcrumbs::add($city->name, '/'. $city->slug);
		?>

		<?php echo Breadcrumbs::render(); ?>


		<h1 class="text-center">Автосервисы в <?php echo e($city->name); ?></h1>

		<p><?php echo $city->text; ?></p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;"><?php echo e($catalog->links()); ?></div>

		<?php foreach($catalog as $item): ?>
			<!-- <article class="catalog-item">
				<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="catalog-item-content" title="Подробнее об автосервисе <?php echo e($item->name); ?>">
					<?php echo $item->description; ?>

				</div>
				<?php echo $__env->make('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
				<a href="<?php echo e(route('catalog.show', [$item->slug])); ?>#comments" title="Отзывы о автосервисе <?php echo e($item->name); ?>">Отзывы (<?php echo e($item->comments_count); ?>)</a>
			</article> -->
			<?php echo $__env->make('catalog.item', compact('item', 'service'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endforeach; ?>
	
		<div class="text-center"><?php echo e($catalog->links()); ?></div>
	</section>
	
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>