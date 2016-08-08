<?php $this->Html->addCrumb('Tag'); ?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">タグの追加</h3>
</div>
<div class="panel-body">
<?php
echo $this->Form->create('Tag', array(
	'url' => array(
		'controller' => 'tags', 'action' => 'add'
	),
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline'
));
echo $this->Form->input('name', array('label' => false, 'class' => 'form-control')); 
echo $this->Form->submit('Add', array(
	'class' => 'btn btn-primary',
	'div' => false));
echo $this->Form->end();
?>
</div><!-- panel-body -->
</div><!-- panel-default -->

<table class="table table-striped table-bordered">
<tr>
<th>ID</th>
<th>Name</th>
<th>Delete</th>
</tr>
<?php foreach($tags as $tag): ?>
<tr>
<td><?php echo $tag['Tag']['id']; ?></td>
<td>
<?php
echo $this->Form->create('Tag', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline'
	));
echo $this->Form->input('name', array(
	'label' => false,
	'class' => 'form-control',
	'default' => $tag['Tag']['name']));
echo $this->Form->hidden('Tag.id', array(
	'value' => $tag['Tag']['id']));
$options = array(
	'label' => 'Edit',
	'div' => false,
	'class' => 'btn btn-primary');
echo $this->Form->end($options);
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $tag['Tag']['id']), array('class' => 'btn btn-danger'), array('confirm' => '削除しても良いですか？')); ?></td>
</tr>
<?php endforeach; ?>
</table>