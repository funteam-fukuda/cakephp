<?php echo $this->Html->css('cake.user'); ?>

<h1><?php echo Configure::read('site_name'); ?></h1>
<table>
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
<?php echo $post['Post']['title']; ?>
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