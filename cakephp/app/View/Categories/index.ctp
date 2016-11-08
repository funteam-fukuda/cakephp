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
echo $this->Form->input('Category.0.name', array('label' => false, 'class' => 'form-control')); 
echo $this->Form->submit('Add', array(
	'class' => 'btn btn-primary cate_addbtn',
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
<?php $i=1; foreach($categories as $category): ?>
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
echo $this->Form->input('Category.' . $i . '.name', array(
	'label' => false,
	'class' => 'form-control edit-cate',
	'default' => $category['Category']['name']));
echo $this->Form->hidden('Category.id', array(
	'value' => $category['Category']['id']));
$options = array(
	'label' => 'Edit',
	'div' => false,
	'class' => 'btn btn-success');
echo $this->Form->end($options);
if (!empty($out[$i]['name'])) echo '<p id="errmsg">' . $out[$i]['name'] . '</p>';
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-danger'), '削除しても良いですか？'); ?></td>
</tr>
<?php $i++; endforeach; ?>
</table>