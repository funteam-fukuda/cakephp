<?php
$this->Html->addCrumb('Group', '/groups');
$this->Html->addCrumb('Edit Group');
?>

<table class="table table-striped table-bordered">
<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Created</th>
		<th>Delete</th>
</tr>
<?php foreach ($groups as $group): ?>
<tr>
	<td><?php echo h($group['Group']['id']); ?></td>
	<td>
	<?php
	echo $this->Form->create('Group', array(
		'inputDefaults' => array(
			'div' => 'form-group',
			'class' => 'form-control'
		),
		'class' => 'form-inline'
		));
	echo $this->Form->input('name', array(
		'label' => false,
		'class' => 'form-control',
		'default' => $group['Group']['name']));
	echo $this->Form->hidden('Group.id', array(
		'value' => $group['Group']['id']));
	$options = array(
		'label' => 'Edit',
		'div' => false,
		'class' => 'btn btn-primary');
	echo $this->Form->end($options);
	?>
	</td>
	<td><?php echo h($group['Group']['created']); ?></td>
	<td>
	<?php echo $this->Form->postLink('Delete', array('controller' => 'groups', 'action' => 'delete', $group['Group']['id']), array('class' => 'btn btn-danger'), array('confirm' => '削除しても良いですか？')); ?>
	</td>
</tr>
<?php endforeach; ?>
</table>