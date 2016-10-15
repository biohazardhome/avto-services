<?php $__env->startSection('title', 'Местоположение автосервиса '. $catalog->name .' на карте'); ?>

<?php $__env->startSection('js'); ?>
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="/js/map.js" type="text/javascript"></script>
    <script src="/js/map-all.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<style>
		/* html, body,  */#map {
            /*width: 600px;*/
            /*height: 450px;*/
            width: 100%;
            height: 700px;
            margin: 0;
            padding: 0;
        }

        h1 {
        	text-align: center;
        }

        main.row {
            background-color: white;
            padding: 25px;
        }
	</style>
	<h1>Автосервис <a href="<?php echo e(route('catalog.show', [$catalog->slug])); ?>" title="Автосервис <?php echo e($catalog->name); ?> в Одинцово"><?php echo e($catalog->name); ?></a> на карте</h1>
	<p><address>Адрес: <?php echo e($catalog->address); ?></address></p>
	<!-- <a href="<?php echo e(route('catalog.index')); ?>" title="Все автосервисы в Одинцово">Все автосервисы в Одинцово</a> -->
	<?php /* <?php echo $__env->make('partials.map', ['catalog' => $catalog], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
	<div id="map"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>