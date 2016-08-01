<table class="table table-striped table-bordered">
<tr>
<th>id</th>
<th>title</th>
<th>category</th>
<th>tag</th>
<th>body</th>
</tr>
<?php foreach ($posts as $post): ?>
<tr>
<td>
<?php echo $post['Post']['id']; ?>
</td>
<td>
<?php echo $this->Html->link($post['Post']['title'], array(
	'controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
</td>
<td>
<?php echo $post['Category']['name']; ?>
</td>
<td>
<?php foreach ($post['Tag'] as $tag): ?>
<?php echo $tag['name']; ?>, 
<?php endforeach; ?>
</td>
<td>
<?php echo $post['Post']['body']; ?>
</td>
</tr>
<?php endforeach; ?>
</table>