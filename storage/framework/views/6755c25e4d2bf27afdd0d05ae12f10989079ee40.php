<div class="dg-wrapper" <?php echo $id ? 'id="'. $id .'"' : null; ?>>

	<?php if($grid->hasFilters()): ?>
		<?php echo Form::open(['role' => 'form', 'method' => 'GET']); ?>


		<?php echo Form::hidden('f[order_by]', $grid->getFilter('order_by', ''));; ?>

		<?php echo Form::hidden('f[order_dir]', $grid->getFilter('order_dir', 'ASC'));; ?>


		<?php foreach($grid->getHiddens() as $name => $value): ?>
			<?php echo Form::hidden($name, $value);; ?>

		<?php endforeach; ?>
	<?php endif; ?>

	<table data-dg-type="table" class="table table-striped table-hover table-bordered">
		<thead>
		<!-- Titles -->
		<tr data-dg-type="titles">
			<?php if($grid->isItBulkable()): ?>
				<th data-dg-col="bulks"><?php if( ! $grid->hasFilters() ): ?><input type="checkbox" /><?php endif; ?></th>
			<?php endif; ?>

			<?php foreach($grid->getColumns() as $col): ?>
				<?php if($col->isAction() === false): ?>
					<th data-dg-col="<?php echo e($col->getKey()); ?>" <?php echo $col->getAttributesHtml(); ?>>
						<?php if($col->isSortable()): ?>
							<a href="<?php echo e(Datagrid::getCurrentRouteLink($grid->getSortParams($col->getKey()))); ?>"><?php echo $col->getTitle(); ?><i class="fa <?php if(\Request::input('f.order_by', '') == $col->getKey() && \Request::input('f.order_dir', 'ASC') == 'ASC'): ?> fa-sort-asc <?php elseif(\Request::input('f.order_by', '') == $col->getKey() && \Request::input('f.order_dir', 'ASC') == 'DESC'): ?> fa-sort-desc <?php else: ?> fa-sort <?php endif; ?>"></i></a>
						<?php else: ?>
							<?php echo e($col->getTitle()); ?>

						<?php endif; ?>
					</th>
				<?php else: ?>
					<th data-dg-col="actions"><!-- Actions --></th>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
		<!-- END Titles -->

		<?php if($grid->hasFilters()): ?>
			<!-- Filters -->
			<tr data-dg-type="filters-row">
				<?php if($grid->isItBulkable()): ?>
					<th data-dg-col="bulks">
						<input type="checkbox" value="1" data-dg-bulk-select="all" />
					</th>
				<?php endif; ?>

				<?php foreach($grid->getColumns() as $col): ?>
					<?php if($col->isAction() === false): ?>
						<?php if($col->hasFilters()): ?>
							<th data-dg-col="<?php echo e($col->getKey()); ?>" <?php echo $col->getAttributesHtml(); ?>>
								<?php if( is_array($col->getFilters()) && count($col->getFilters()) > 0 ): ?>
									<?php echo Form::select(
											$col->getFilterName(),
											$col->getFilters(true),
											$grid->getFilter($col->getKey()),
											($col->hasFilterMany() ? ['multiple' => 'multiple'] : []) + array('class' => 'form-control input-sm', 'data-dg-type' => "filter")
										); ?>

								<?php else: ?>
									<?php echo Form::text(
											$col->getFilterName(),
											$grid->getFilter($col->getKey()),
											array('class' => 'form-control input-sm', 'data-dg-type' => "filter", 'placeholder' => $col->getTitle())
										); ?>

								<?php endif; ?>
							</th>
						<?php else: ?>
							<th data-dg-col="<?php echo e($col->getKey()); ?>">&nbsp;</th>
						<?php endif; ?>
					<?php else: ?>
						<th data-dg-col="actions">
							<button class="btn btn-success btn-sm" type="submit" title="Search..."><i class="fa fa-search" aria-hidden="true"></i></button>
							<a href="<?php echo e(\Request::url()); ?>" class="btn btn-danger btn-sm" title="Clear filters"><i class="fa fa-remove" aria-hidden="true"></i></a>
						</th>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
			<!-- END Filters -->
		<?php endif; ?>
		</thead>

		<tbody>
		<?php $__empty_1 = true; foreach($grid->getRows() as $row): $__empty_1 = false; ?>
			<tr data-dg-type="data-row">
				<?php if($grid->isItBulkable()): ?>
					<th data-dg-col="bulks"><input type="checkbox" value="<?php echo e($row->{$grid->getBulk()}); ?>" data-dg-bulk-select="row" /></th>
				<?php endif; ?>

				<?php foreach($grid->getColumns() as $col): ?>
					<td data-dg-col="<?php echo e($col->getKey()); ?>" <?php echo $col->getAttributesHtml(); ?>>
						<?php if($col->hasWrapper()): ?>
							<?php echo $col->wrapper($row->{$col->getKey(true)}, $row); ?>

						<?php else: ?>
							<?php echo $row->{$col->getKey(true)}; ?>

						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; if ($__empty_1): ?>
			<tr data-dg-type="empty-result">
				<td colspan="<?php echo e($grid->getColumnsCount()); ?>">
					No results found!
				</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>

	<?php if($grid->hasFilters()): ?>
		<?php echo Form::close(); ?>

	<?php endif; ?>

	<?php if($grid->hasPagination()): ?>
		<div class="row-fluid text-center">
			<?php echo $grid->getPagination()->render(); ?>

		</div>
	<?php endif; ?>

</div><!-- /.dg-wrapper -->
