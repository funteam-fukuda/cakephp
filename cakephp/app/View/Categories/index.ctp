<?php $this->Html->addCrumb('Category'); ?>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">カテゴリの追加</h3>
</div>
<div class="panel-body">
<?php
echo $this->Form->create('Category', array(
	'url' => array(
		'controller' => 'categories', 'action' => 'add'
	),
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline',
	'novalidate' => true
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
<?php foreach($categories as $category): ?>
<tr>
<td><?php echo $category['Category']['id']; ?></td>
<td>
<?php
echo $this->Form->create('Category', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline',
	'novalidate' => true
	));
echo $this->Form->input('name', array(
	'label' => false,
	'class' => 'form-control',
	'default' => $category['Category']['name']));
echo $this->Form->hidden('Category.id', array(
	'value' => $category['Category']['id']));
$options = array(
	'label' => 'Edit',
	'div' => false,
	'class' => 'btn btn-primary');
echo $this->Form->end($options);
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-danger'), array('confirm' => '削除しても良いですか？')); ?></td>
</tr>
<?php endforeach; ?>
</table>