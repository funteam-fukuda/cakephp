<?php $this->Html->addCrumb('Group'); ?>

<div id="xs-btn">
<?php
	echo $this->Html->link('追加', array(
		'controller' => 'groups', 'action' => 'add'), array('class' => 'btn btn-primary btn-xs'));
	echo $this->Html->link('編集・削除', array(
		'controller' => 'groups', 'action' => 'edit'), array('class' => 'btn btn-primary btn-xs'));
?>
</div>

<table class="table table-striped table-bordered">
<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Created</th>
</tr>
<?php foreach ($groups as $group): ?>
<tr>
	<td><?php echo h($group['Group']['id']); ?></td>
	<td>
	<?php echo h($group['Group']['name']); ?>
	</td>
	<td><?php echo h($group['Group']['created']); ?></td>
</tr>
<?php endforeach; ?>
</table>