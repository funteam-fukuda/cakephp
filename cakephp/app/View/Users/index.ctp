<?php $this->Html->addCrumb('User'); ?>

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