<?php $this->Html->addCrumb('User'); ?>

<div id="xs-btn">
<?php
	echo $this->Html->link('追加', array(
		'controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-primary btn-xs'));
	echo $this->Html->link('編集・削除', array(
		'controller' => 'users', 'action' => 'edit'), array('class' => 'btn btn-success btn-xs'));
?>
</div>

<table class="table table-striped table-bordered">
<tr>
<th>Id</th>
<th>username</th>
<th>created</th>
</tr>
<?php foreach($users as $user): ?>
<tr>
<td><?php echo $user['User']['id']; ?></td>
<td><?php echo $user['User']['username']; ?></td>
<td><?php echo $user['User']['created']; ?></td>
</tr>
<?php endforeach; ?>
</table>