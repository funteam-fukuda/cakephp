<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php

        echo $this->Html->meta('icon');

        echo $this->Html->script('http://code.jquery.com/jquery-1.11.0.min.js');
        echo $this->Html->script('https://code.jquery.com/ui/1.10.3/jquery-ui.js');

        // Twitter Bootstrap 3.0 CDN
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->script('bootstrap.min.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
<?php echo $this->Html->script('searchform.js'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
<?php echo $this->Html->script('sidebar.js'); ?>
<?php echo $this->Html->script('zipcode.js'); ?>

	<div id="con1" class="modal-content">
		<div id="img-block"></div>
		<p><a class="modal-close"></a></p>
	</div>

	<div class="navbar">
		<div class="well">
			<div class="container">

				<?php echo $this->element('header'); ?>
				
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row">

			<?php echo $this->element('sidebar'); ?>
			
			<!--<h1><?php echo Configure::read('site_name'); ?></h1>-->
			<?php echo $this->element('breadcrumbs'); ?>

			<?php echo $this->Session->flash(); ?>
			
			<div class="col-lg-8">
				<?php echo $this->fetch('content'); ?>
			</div><!-- end col-lg-8 -->
			
			<div class="col-lg-4">
				<?php echo $this->element('sidemenu'); ?>
			</div><!-- end col-lg-4 -->

		</div><!-- end row -->

	</div> <!-- /container -->

	<!--<?php echo $this->element('footer'); ?>-->
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->fetch('script'); ?>
  </body>
</html>