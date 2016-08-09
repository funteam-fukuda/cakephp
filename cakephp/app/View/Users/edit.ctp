<?php $this->Html->addCrumb('User'); ?>
<table class="table table-striped table-bordered">
<tr>
<th>Id</th>
<th>Username</th>
<th>Created</th>
<th>Delete</th>
</tr>
<?php foreach($users as $user): ?>
<tr>
<td>
<?php echo $user['User']['id']; ?>
</td>
<td>
<?php
echo $this->Form->create('User', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'class' => 'form-inline'
	));
echo $this->Form->input('username', array(
	'label' => false,
	'class' => 'form-control',
	'default' => $user['User']['username']));
echo $this->Form->hidden('User.id', array(
	'value' => $user['User']['id']));
$options = array(
	'label' => 'Edit',
	'div' => false,
	'class' => 'btn btn-primary');
echo $this->Form->end($options);
?>
</td>
<td><?php echo $user['User']['created']; ?></td>
<td>
	<?php echo $this->Form->postLink('Delete', array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger'), array('confirm' => '削除しても良いですか？')); ?>
</td>
</tr>
<?php endforeach; ?>
</table>