<?php echo $this->Html->script('searchform.js'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
<?php echo $this->Html->css('cake.user'); ?>

<?php echo $this->Html->link(
	'Add Post', array('action' => 'add')); ?>

<?php echo $this->Html->link(
	'Logout', array('controller' => 'users', 'action' => 'logout')); ?>

<h1><?php echo Configure::read('site_name'); ?></h1>
<table style="width:800px;">
<?php foreach ($posts as $post): ?>
<tr><td class="post-title"><?php echo $post['Post']['title']; ?></td></tr>
<tr>
<td>
<?php echo $post['Post']['created']; ?>
 by <?php echo $post['User']['username']; ?> 
<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>, 
<?php echo $this->Form->postLink('Delete',
								 array('action' => 'delete', $post['Post']['id']),
								 array('confirm' => 'Are you sure?')); ?>
</td>
<tr>
<td>
Category: <?php echo $post['Category']['name']; ?>
</td>
</tr>
<tr>
<td>
Tag: 
<?php foreach ($post['Tag'] as $tag): ?>
<?php echo $tag['name']; ?>, 
<?php endforeach; ?>
</td>
</tr>
<tr><td>
<?php
// http://192.168.33.10/cakephp/files/attachment/photo/14/maxresdefault.jpg
for ($i=0;$i<count($post['Attachment']);$i++) {
	if ($post['Attachment'][$i]['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $post['Attachment'][$i]['photo_dir'] . '/' . $post['Attachment'][$i]['photo'];
		echo $this->Html->image($imgurl,
			array('width' => '100', 'height' => '100', 'class' => 'active'));
	}
}
?>
</td></tr>
<tr><td><?php echo $post['Post']['body']; ?></td></tr>
</tr>
<?php endforeach; ?>
</table>

<?php echo $this->Paginator->prev('< prev', array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(array('separator' => '')); ?>
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>