<?php echo $this->Html->script('searchform.js'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
<?php echo $this->Html->script('zipcode.js'); ?>

<div class="clickArea">search form</div>
<div class="searchArea">
	<?php
	echo $this->Form->create('Post', array(
		'novalidate' => true,
		'url' => array_merge(array('action' => 'search'), $this->params['pass'])
		));
	echo $this->Form->input('title', array('div' => false));
	echo $this->Form->input('Post.category', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $categories
	));
	echo $this->Form->input('Post.tag', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $tags
	));
	echo $this->Form->submit('Search', array(
		'class' => 'btn'));
	echo $this->Form->end();
	?>
</div>

<?php
echo $this->Form->create('PostalCode', array(
	'url' => 'javascript:void(0)'));
echo $this->Form->input('request', array(
	'label' => false));

echo $this->Form->input('result', array(
	'type' => 'select',
	'id' => 'result_zipcode',
	'label' => false));

echo $this->Form->submit('Search', array(
	'id' => 'searchZipCode', 'class' => 'btn'));
echo $this->Form->end();
?>
<?php echo $this->Html->link(
	'Add Post', array('action' => 'add')); ?>

<?php echo $this->Html->link(
	'Logout', array('controller' => 'users', 'action' => 'logout')); ?>

<?php foreach ($posts as $post): ?>
<h2 class="post-title"><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></h2>
<?php echo $post['Post']['created']; ?>
 by <?php echo $post['User']['username']; ?> 
<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>, 
<?php echo $this->Form->postLink('Delete',
								 array('action' => 'delete', $post['Post']['id']),
								 array('confirm' => 'Are you sure?')); ?>
Category: <?php echo $post['Category']['name']; ?>
Tag: 
<?php foreach ($post['Tag'] as $tag): ?>
<?php echo $tag['name']; ?>, 
<?php endforeach; ?>

<?php
echo '<div id="' . $post['Post']['id'] . '">';
$cnt = 0;
foreach ($post['Attachment'] as $value) {
	if ($value['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $value['photo_dir'] . '/' . $value['photo'];
		echo $this->Html->link(
			$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100')),
			'javascript:void(0)',
			array('escape' => false, 'data-target' => 'con1', 'class' => "modal-open $cnt")
		);
		$cnt++;
	}
}
echo '</div>';
?>
<?php echo $post['Post']['body']; ?>

<?php endforeach; ?>

<div class="pagination pagination-centered">
<ul>
<?php echo $this->Paginator->prev('< prev', array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(array('separator' => '')); ?>
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>
</ul>
</div><!-- end pagination -->