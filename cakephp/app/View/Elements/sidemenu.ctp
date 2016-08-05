<div id="sidemenu" class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Tag Cloud</h3>
</div>
<div class="panel-body">
<?php foreach($head_tags as $key => $val): ?>
<?php echo $this->Html->link($val, array(
	'controller' => 'posts',
	'action' => 'search',
	'?' => array('tag[0]' => $key))) . ' ';
?>
<?php endforeach; ?>
</div><!-- panel-body -->
</div><!-- sidemenu -->