<?php $serviceSingularLcFirst = (isset($service) && isset($service->singular_lc_first)) ? $service->singular_lc_first : null;?>
<article class="catalog-item">
	<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="catalog-item-content" title="Подробнее об <?php echo e($serviceSingularLcFirst); ?>е <?php echo e($item->name); ?>">
		<?php echo $item->description; ?>

	</div>
	<?php echo $__env->make('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<a 
		href="<?php echo e(route('catalog.show', [$item->slug])); ?>#comments" 
		title="Отзывы о <?php echo e($serviceSingularLcFirst); ?>е <?php echo e($item->name); ?>">
		Отзывы (<?php echo e($item->comments_count); ?>)
	</a>
</article>