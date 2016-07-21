<table>
<tr>
<th>Id</th>
<th>username</th>
<th>role</th>
<th>created</th>
</tr>
<?php foreach($users as $user): ?>
<tr>
<td><?php echo $user['User']['id']; ?></td>
<td><?php echo $user['User']['username']; ?></td>
<td><?php echo $user['User']['role']; ?></td>
<td><?php echo $user['User']['created']; ?></td>
</tr>
<?php endforeach; ?>
</table>