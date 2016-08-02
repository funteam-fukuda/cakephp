<div class="well">
<?php echo $this->Form->create('Category', array('url' => array('controller' => 'categories', 'action' => 'add'))); ?>
<?php echo $this->Form->input('name', array(
	'div' => false)); ?>
<?php
$options = array(
	'label' => '追加',
	'div' => false);
echo $this->Form->end($options);
?>
</div>

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
echo $this->Form->create('Category');
echo $this->Form->input('name', array(
	'label' => false,
	'div' => false,
	'default' => $category['Category']['name']));
echo $this->Form->hidden('Category.id', array(
	'value' => $category['Category']['id']));
$options = array(
	'label' => '変更',
	'div' => false);
echo $this->Form->end($options);
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $category['Category']['id']), array('confirm' => '削除しても良いですか？')); ?></td>
</tr>
<?php endforeach; ?>
</table>