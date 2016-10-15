
<?php if(Session::has('message')): ?>
	<div class="alert alert-danger"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<?php if($errors->count()): ?>
	<ul>
		<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<form class="comment-form-create" action="<?php echo e(route('comment.store')); ?>" method="POST">
	<?php echo e(csrf_field()); ?>

	<?php echo e(method_field('put')); ?>

	<input type="hidden" name="catalog_id" value="<?php echo e($catalogId); ?>">
	
	<div class="row ">
	<div class="form-group col-md-4 col-lg-4">
		<label class="sr-only">Имя</label>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
			<input class="form-control input-sm" type="text" name="name" value="" placeholder="Имя" required>
		</div>
	</div>
	
	<div class="form-group col-md-4 col-lg-4">
		<label class="sr-only">Почта</label>
		<div class="input-group">
			<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
			<input class="form-control input-sm" type="email" name="email" value="" placeholder="Почта" required>
		</div>
	</div>

	<div class="form-group col-md-8 col-lg-8">
		<label class="sr-only">Сообщение</label>
		<textarea class="form-control input-sm" name="msg" rows="6" placeholder="Сообщение" required></textarea>
	</div>
	</div>

	<button class="btn btn-default">Отправить</button>

</form>