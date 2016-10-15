<!DOCTYPE html>
<html lang="en">
<html><head>
	<title>Админка <?php echo $__env->yieldContent('title'); ?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
	
	<link rel="stylesheet" type="text/css" href="/css/jquery.kladr.min.css">
	<link rel="stylesheet" type="text/css" href="/trumbowyg/ui/trumbowyg.min.css">
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="/css/index.css" rel="stylesheet" type="text/css">
	<link href="/css/catalog.css" rel="stylesheet" type="text/css">
	<link href="/css/map.css" rel="stylesheet" type="text/css">

	<?php echo $__env->yieldContent('assetsCSS'); ?>
	
</head><body>

	<header>
		<nav class="navbar navbar-default navbar-static-top">
	        <div class="container">
	            <div class="navbar-header">

	                <!-- Collapsed Hamburger -->
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
	                    <span class="sr-only">Toggle Navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>

	                <!-- Branding Image -->
	                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
	                    Site
	                </a>
	            </div>

	            <div class="collapse navbar-collapse" id="app-navbar-collapse">
	                <!-- Left Side Of Navbar -->
	                <ul class="nav navbar-nav">
	                    <li><a href="<?php echo e(url('/admin')); ?>">Admin</a></li>
	                    <li><a href="<?php echo e(url('/admin/catalog')); ?>">Catalog</a></li>
	                    <li><a href="<?php echo e(url('/admin/comment')); ?>">Comments</a></li>
	                    <li><a href="<?php echo e(url('/admin/city')); ?>">Cities</a></li>
	                    <li><a href="<?php echo e(url('/admin/city-catalog')); ?>">Cities Catalog</a></li>
	                    <li><a href="<?php echo e(url('/admin')); ?>">Images</a></li>
	                </ul>

	                <!-- Right Side Of Navbar -->
	                <ul class="nav navbar-nav navbar-right">
	                    <!-- Authentication Links -->
	                    <?php if(Auth::guest()): ?>
	                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
	                        <!--<li><a href="<?php echo e(url('/register')); ?>">Register</a></li>-->
	                    <?php else: ?>
	                        <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
	                            </a>

	                            <ul class="dropdown-menu" role="menu">
	                                <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
	                            </ul>
	                        </li>
	                    <?php endif; ?>
	                </ul>
	            </div>
	        </div>
	    </nav>
	</header>

	<main><?php echo $__env->yieldContent('content'); ?></main>
	
	<aside><?php echo $__env->yieldContent('sidebar'); ?></aside>

	<footer>
		

	</footer>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
	<!-- <script src="/js/jquery-3.0.0.min.js" type="text/javascript"></script> -->
	<script src="/js/jquery.kladr.min.js" type="text/javascript"></script>
	<script src="/trumbowyg/trumbowyg.min.js" type="text/javascript"></script>
	<script>
		$('.trumbowyg').trumbowyg();
	</script>
	<?php echo $__env->yieldContent('assetsJS'); ?>

</body></html>
