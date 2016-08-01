<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('bootstrap-responsive.min'); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<!--
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php echo $this->Html->script('searchform.js'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
</head>

<body>
<div id="con1" class="modal-content">
	<div id="img-block"></div>
	<p><a class="modal-close">閉じる</a></p>
</div>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">

				<?php echo $this->element('header'); ?>
				
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row">

			<h1><?php echo Configure::read('site_name'); ?></h1>

			<?php echo $this->Session->flash(); ?>
			
			<div class="col-md-8">
				<?php echo $this->fetch('content'); ?>
			</div><!-- end col-lg-8 -->
			
			<div class="col-md-4">
				<?php echo $this->element('sidebar'); ?>
			</div><!-- end col-lg-4 -->

		</div><!-- end row -->

	</div> <!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>-->
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>
</body>
</html>
