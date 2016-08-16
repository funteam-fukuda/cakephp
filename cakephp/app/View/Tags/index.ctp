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
		'class' => 'form-control',
		'wrapInput' => false
	),
	'class' => 'form-inline',
	'novalidate' => true
));
echo $this->Form->input('Tag.0.name', array('label' => false, 'class' => 'form-control', 'div' => false)); 
$options = array(
	'label' => 'Add',
	'div' => 'form-group',
	'class' => 'btn btn-primary tag_addbtn');
echo $this->Form->end($options);
?>
</div><!-- panel-body -->
</div><!-- panel-default -->

<table class="table table-striped table-bordered">
<tr>
<th>ID</th>
<th>Name</th>
<th>Delete</th>
</tr>
<?php $i=1; foreach($tags as $tag): ?>
<tr>
<td><?php echo $tag['Tag']['id']; ?></td>
<td>
<?php
echo $this->Form->create('Tag', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline',
	'novalidate' => true
	));
echo $this->Form->input('Tag.' . $i . '.name', array(
	'label' => false,
	'class' => 'form-control edit-tag',
	'div' => 'form-group',
	'default' => $tag['Tag']['name']));
echo $this->Form->hidden('Tag.id', array(
	'value' => $tag['Tag']['id']));
$options = array(
	'label' => 'Edit',
	'div' => false,
	'class' => 'btn btn-primary');
echo $this->Form->end($options);
if (!empty(@$out)) echo '<p id="errmsg">' . @$out[$i]['name'] . '</p>';
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $tag['Tag']['id']), array('class' => 'btn btn-danger'), '削除しても良いですか？'); ?></td>
</tr>
<?php $i++; endforeach; ?>
</table>