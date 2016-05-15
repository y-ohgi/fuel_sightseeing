<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<title><?php if($title)echo $title." | "; ?>Sightseeing</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>
	</style>
    </head>
    <body>
	<header class="navbar navbar-default">
	    <div class="container-fluid">
		<a class="navbar-brand" href="<?php Uri::create("/"); ?>"><h1>Sightseeing</h1></a>
		
		<ul class="nav navbar-nav navbar-right">
		    <?php if(Auth::check()): ?>
			<li><a href="<?php echo Uri::create("auth/signout");?>">サインアウト</a></li>
		    <?php else:?>
			<li><a href="<?php echo Uri::create("auth/signup");?>">サインアップ</a></li>
			<li><a href="<?php echo Uri::create("auth/signin");?>">サインイン</a></li>
		    <?php endif ?>
		</ul>
	    </div>
	</header>
	
	<div class="container">
	    <div class="col-md-12">
		<hr>
		<?php if (Session::get_flash('success')): ?>
		    <div class="alert alert-success">
			<strong>Success</strong>
			<p>
			    <?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
			</p>
		    </div>
		<?php endif; ?>
		<?php if (Session::get_flash('error')): ?>
		    <div class="alert alert-danger">
			<strong>Error</strong>
			<p>
			    <?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
			</p>
		    </div>
		<?php endif; ?>
	    </div>
	    <div class="col-md-12">
		<?php echo $content; ?>
	    </div>
	    <footer>
		<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
		<p>
		    <a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
		    <small>Version: <?php echo e(Fuel::VERSION); ?></small>
		</p>
	    </footer>
	</div>
    </body>
</html>
