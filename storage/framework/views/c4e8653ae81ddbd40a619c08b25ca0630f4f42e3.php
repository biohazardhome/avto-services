<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="<?php echo e(route('catalog.show', [$item->slug])); ?>#map" title="Узнать расположение автосервиса <?php echo e($item->name); ?> на карте">
		<?php echo e($item->addressRegion); ?>, <?php echo e($item->addressCityShort); ?>, <?php echo e($item->addressBuilding); ?>

	</a>
</address>