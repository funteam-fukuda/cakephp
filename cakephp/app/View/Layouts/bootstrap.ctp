<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php

        echo $this->Html->meta('icon');

        // Twitter Bootstrap 3.0 CDN
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('http://code.jquery.com/jquery-1.11.0.min.js');
        echo $this->Html->script('https://code.jquery.com/ui/1.10.3/jquery-ui.js');
        echo $this->Html->css('bootstrap.min.css');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
<?php echo $this->Html->script('searchform.js'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
<?php echo $this->Html->script('zipcode.js'); ?>

	<div id="con1" class="modal-contents">
		<div id="img-block"></div>
		<p><a class="modal-close"></a></p>
	</div>

	<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">

				<?php echo $this->element('header'); ?>
				
			</div>
	</div>

	<header class="sb-page-header">
	<div class="container">
		<h1>blog.dev</h1>
		<p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.</p>
	</div>
	</header>

	<div class="container">

		<div class="row">
			
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

	<?php echo $this->element('footer'); ?>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->fetch('script'); ?>
  </body>
</html>