<?php
	$city = $catalog->city;
	$service = $catalog->service;
?>

<?php $__env->startSection('title', 'Автосервис '. $catalog->name .' в Одинцово'); ?>
<?php $__env->startSection('description', trim(str_limit_with(strip_tags($catalog->description), 200)) ); ?>
<?php $__env->startSection('content'); ?>
	<section class="catalog-show col-md-9 col-lg-9">

		<?php
			Breadcrumbs::setCssClasses('breadcrumb');
			Breadcrumbs::setDivider('');
			Breadcrumbs::add($service->name, '/'. $city->slug .'/'. $service->slug);
			Breadcrumbs::add($city->name, '/'. $city->slug .'/'. $service->slug);
			Breadcrumbs::add($catalog->name, '/'. $catalog->slug);
		?>

		<?php echo Breadcrumbs::render(); ?>


		<article class="catalog-item bg-gray">
			<div class="catalog-item-well">
				<?php echo $__env->make('catalog.partials.item-header', $catalog->getAttributesOnly(['name']) + ['city' => $catalog->city], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('catalog.partials.item-address-short', ['item' => $catalog], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<div class="catalog-description"><?php echo $catalog->description; ?></div>

				<?php echo $__env->make('catalog.partials.item-info', $catalog->getAttributesOnly(['phones', 'site', 'email', 'name']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				<div class="catalog-content"><?php echo $catalog->content; ?></div>

				<div>
					<a 
						href="<?php echo e(route('main', [$city->slug, $service->slug])); ?>" 
						title=""
					>Все <?php echo e($service->name); ?> в <?php echo e($city->name); ?></a>
				</div>
			</div>

			<div class="catalog-map catalog-item-well">
				<a name="map"></a>
				<h2><?php echo e($service->singular); ?> "<?php echo e($catalog->name); ?>" на карте</h2>
				<?php echo $__env->make('partials.map', ['catalog' => $catalogMap], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<div id="map" style="width:auto; height: 450px;"></div>
				<a href="/map/<?php echo e($catalog->city->slug); ?>/">Все <?php echo e($service->nameLcFirst); ?> в <?php echo e($catalog->city->name); ?> на карте</a>
			</div>

			<div class="catalog-comment catalog-item-well">
				<a name="comments"></a>
				
				<div class="comment-actions">
					<div class="comment-actions pull-right">
						<a href="#" class="comment-form-show btn btn-default" title="Показать форму отзывов">Написать</a>
					</div>
					<h2>
						Отзывы об <?php echo e($service->singularLcFirst); ?>е "<?php echo e($catalog->name); ?>" в <?php echo e($catalog->city->name); ?>

					</h2>
				</div>
				<?php echo $__env->make('comment.create', ['catalogId' => $catalog->id], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo $__env->make('comment.index', ['comments' => $catalog->comments], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				
			</div>
		</article>
		
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
	<aside class="col-sm-12 col-md-3 col-lg-3">
		<div class="catalog-similar-wrap">
			<div class="catalog-similar">
				<?php $similar = app('App\Catalog'); ?>
				
				<h3><?php echo e($service->name); ?> на <?php echo e($catalog->addressStreet); ?></h3>
				<ul class="catalog-list-similar">
					<?php foreach($similar->LikeByAddress($catalog->addressStreet, 3) as $item): ?>
						<li>
							<article class="catalog-item">
								<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</article>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="catalog-similar">
				<?php $similar = app('App\Catalog'); ?>
				
				<h3><?php echo e($service->name); ?> в городе <?php echo e($catalog->addressCityShort); ?></h3>
				<ul class="catalog-list-similar">
					<?php foreach($similar->LikeByAddress($catalog->addressCity, 3) as $item): ?>
						<li>
							<article class="catalog-item">
								<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</article>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="catalog-similar">
				<?php $catalog = app('App\Catalog'); ?>
				
				<h3>Популярные <?php echo e($service->nameLcFirst); ?> <?php echo e($catalog->addressCityShort); ?> в <?php echo e($city->name); ?></h3>
				<ul class="catalog-list-similar">
					<?php foreach($catalog->whereCityId($city->id)->orderBy('sort', 'desc')->limit(3)->get() as $item): ?>
						<li>
							<article class="catalog-item">
								<?php echo $__env->make('catalog.partials.item-header-link', $item->getAttributesOnly(['name', 'slug']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php echo $__env->make('catalog.partials.item-address-anchor', $item->getAttributesOnly(['slug', 'name', 'address']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</article>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
		</div>
	</aside>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>