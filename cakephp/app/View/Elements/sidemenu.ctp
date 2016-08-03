<div id="sidemenu">
<h3>Tag Cloud</h3>
<?php foreach($tags as $key => $val): ?>
<?php echo $this->Html->link($val, array(
	'controller' => 'posts',
	'action' => 'search',
	'?' => array('tag[0]' => $key))) . ' ';
?>
<?php endforeach; ?>
</div>