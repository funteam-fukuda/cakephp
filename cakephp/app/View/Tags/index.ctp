<div class="well">
<?php echo $this->Form->create('Tag', array('url' => array('controller' => 'tags', 'action' => 'add'))); ?>
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
<?php foreach($tags as $tag): ?>
<tr>
<td><?php echo $tag['Tag']['id']; ?></td>
<td>
<?php
echo $this->Form->create('Tag');
echo $this->Form->input('name', array(
	'label' => false,
	'div' => false,
	'default' => $tag['Tag']['name']));
echo $this->Form->hidden('Tag.id', array(
	'value' => $tag['Tag']['id']));
$options = array(
	'label' => '変更',
	'div' => false);
echo $this->Form->end($options);
?>
</td>
<td><?php echo $this->Form->postLink('Delete', array('action' => 'delete', $tag['Tag']['id']), array('confirm' => '削除しても良いですか？')); ?></td>
</tr>
<?php endforeach; ?>
</table>