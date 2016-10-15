<?php $__env->startSection('title', 'Автосервисы в Одинцово на карте'); ?>
<?php $__env->startSection('description', ''); ?>

<?php $__env->startSection('js'); ?>
	<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<script src="/js/map.js" type="text/javascript"></script>
	<script src="/js/map-all.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var promise = mapCity('<?php echo e($city->slug); ?>')/*.done(function(data) {
				console.log(data)
			})*/;

			console.log(promise)

		});
	</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<style type="text/css">
		html, body, main, section {
			width: 100%;
			height: 100%;
		}

		body {
			/*padding: 10px;*/
		}

		section {
			
		}

		h1 {
			font-size: 16px;
		    text-transform: uppercase;
		    color: #615c5c;
		}

        #map-all {
            /*width: 700px;*/
            /*height: 450px;*/
            width: 100%;
            /*height: 700px;*/
            height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
        	height: auto;
        }
    </style>
    

	<section>
		<h1>Автосервиса в <?php echo e($city->name); ?></h1>

		<div id="map-all"></div>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>