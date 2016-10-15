<address>
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="<?php echo e(route('map.show', [$slug, $address])); ?>" title="Узнать расположение автосервиса <?php echo e($name); ?> на карте"><?php echo e($address); ?></a>
</address>