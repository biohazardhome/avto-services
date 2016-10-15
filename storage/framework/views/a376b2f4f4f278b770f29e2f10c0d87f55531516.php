<div class="catalog-item-info">
	<ul class="list-unstyled">
		<li class="catalog-item-phones">
			<span class="glyphicon glyphicon-phone-alt"></span>
			<span><b><?php echo e($phones); ?></b></span>
		</li>
		<?php if($site): ?>
			<li>
				<span class="glyphicon glyphicon-globe"></span>
				<a href="http://<?php echo e($site); ?>" title="Сайт автосервиса <?php echo e($name); ?>" rel="nofollow" target="_blank"><?php echo e(str_replace('www.', '', $site)); ?></a>
			</li>
		<?php endif; ?>
		<?php if($email): ?>
			<div>
				<span class="glyphicon glyphicon-envelope"></span>
				<a href="mailto:<?php echo e($email); ?>"><?php echo e($email); ?></a></span>
			</div>
		<?php endif; ?>
	</ul>
</div>