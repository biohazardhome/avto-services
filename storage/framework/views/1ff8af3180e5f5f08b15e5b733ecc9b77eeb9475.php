<?php if($catalog->count()): ?>

		<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		<script src="/js/map.js" type="text/javascript"></script>
		<script src="/js/map-all.js" type="text/javascript"></script>
		

	<style>
	    #map-all {
	        width: 100%;
	        height: 400px;
	    }
	</style>

	<?php $type = decline_number($catalog->count(), ['автосервис', 'автосервиса', 'автосервисов']); ?>
	<?php if($city): ?>
		<h2 class="text-center">Автосервисы в <?php echo e($city->name); ?> на карте <span class="lead text-muted">(<?php echo e($catalog->count()); ?>) <?php echo e($type); ?></span></h2>
	<?php else: ?>
		<h2 class="text-center">Все автосервисы на карте <span class="lead text-muted">(<?php echo e($catalog->count()); ?>) <?php echo e($type); ?></span></h2>
	<?php endif; ?>
	<?php echo $__env->make('partials.map-all', ['catalog' => $catalog], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div id="map-all"></div>

	<?php if($city): ?>
		<?php $__env->startSection('js'); ?>

			<script type="text/javascript">
				$(document).ready(function() {
					var promise = mapCity('<?php echo e($city->slug); ?>')/*.done(function(data) {
						console.log(data)
					})*/;
				});
			</script>
		<?php $__env->stopSection(); ?>
		<a href="/map/<?php echo e($city->slug); ?>/">Все <?php echo e($service->name); ?> в <?php echo e($city->name); ?> на карте</a>
	<?php else: ?>
		<a href="/map/">Все <?php echo e($service->nameLcFirst); ?> на карте</a>
	<?php endif; ?>
<?php endif; ?>