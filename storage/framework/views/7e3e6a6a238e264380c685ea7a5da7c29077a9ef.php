<?php $__env->startSection('title', 'Автосервисы в Одинцово - адреса и телефоны'); ?>
<?php $__env->startSection('description', 'Автосервисы в Одинцово - каталог адресов и телефонов автосервисов в Одинцово с полной справочной информацией и отзывами'); ?> <!-- полная справочная информация, схема проезда-->

<?php $__env->startSection('content'); ?>

	<section class="catalog-list col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
		<h1 class="text-center">Автосервисы в Одинцово</h1>

		<p>У вас поломался автомобиль и срочно нужен автосервис в Одинцово? Наш каталог автосервисов в Одинцово поможет найти ближайший подходящий сервис для вас и вашей машины. Так же вы можете получить полную информацию о интересующем вас автосервисе, от адреса и телефона, до расположения на карте и воспользоваться функционалом поиска автосервиса на карте и обратным звонком прямо в интересующий вас автосервис.</p>

		<div class="text-center" style="border-bottom: 1px solid #dad8d8;"><?php echo e($catalog->links()); ?></div>

		<?php foreach($catalog as $item): ?>
			<article class="catalog-item">
				<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div class="catalog-item-content" title="Подробнее об автосервисе <?php echo e($item->name); ?>">
					<?php echo $item->description; ?>

				</div>
				<?php echo $__env->make('catalog.partials.item-info', $item->getAttributesOnly(['phones', 'site', 'email', 'name']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<a href="<?php echo e(route('catalog.show', [$item->slug])); ?>#comments" title="Отзывы о автосервисе <?php echo e($item->name); ?>">Отзывы (<?php echo e($item->comments_count); ?>)</a>
			</article>
		<?php endforeach; ?>
	
		<div class="text-center"><?php echo e($catalog->links()); ?></div>
	</section>
	
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>