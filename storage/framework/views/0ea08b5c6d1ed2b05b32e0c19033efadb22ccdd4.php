<?php $required = isset($required) && $required == true ? 'required' : ''; ?>
<input type="file" name="images" value="" accept="image/png,image/jpg,image/jpeg,images/gif" multiple <?php echo e($required); ?>>
