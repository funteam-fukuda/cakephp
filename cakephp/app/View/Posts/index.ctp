<?php
echo $this->Html->link(
	'Add Post', array('action' => 'add'));
echo ' | ';
echo $this->Html->link(
	'Login', array('controller' => 'users', 'action' => 'login'));
echo ' | ';
echo $this->Html->link(
	'Logout', array('controller' => 'users', 'action' => 'logout'));
?>

<?php foreach ($posts as $post): ?>
<div class="postwrap">
<h2 class="post-title"><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></h2>
<?php echo $post['Post']['created']; ?>
 by <?php echo $post['User']['username']; ?> 
<?php if (!is_null($login)): ?>
<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>, 
<?php echo $this->Form->postLink('Delete',
								 array('action' => 'delete', $post['Post']['id']),
								 array('confirm' => 'Are you sure?')); ?>
<?php endif; ?>
 Category: <?php echo $post['Category']['name']; ?>
 Tag: 
<?php foreach ($post['Tag'] as $tag): ?>
<?php echo $tag['name']; ?>, 
<?php endforeach; ?>

<?php
echo '<div class="index-img" id="' . $post['Post']['id'] . '">';
$cnt = 0;
foreach ($post['Attachment'] as $value) {
	if ($value['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $value['photo_dir'] . '/' . $value['photo'];
		echo $this->Html->link(
			$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100', 'class' => 'img-thumbnail imgthmb')),
			'javascript:void(0)',
			array('escape' => false, 'data-target' => 'con1', 'class' => "modal-open $cnt")
		);
		$cnt++;
	}
}
echo '</div>';
?>
<?php
echo mb_strimwidth($post['Post']['body'], 0, 100, '...', 'utf-8');
?>
</div><!-- div.postwrap end -->
<?php endforeach; ?>

<ul class="pager">
<?php echo $this->Paginator->prev('< prev', array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(array('separator' => '')); ?>
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>
</ul>