<?php $this->Html->addCrumb('Post'); ?>

<div id="post-sort">
	<ul class="list-inline">
		<li><span>並び替え:</span></li>
		<li><?php echo $this->Paginator->sort('created', '投稿日'); ?></li>
		<li><?php echo $this->Paginator->sort('modified', '更新日'); ?></li>
		<li><?php echo $this->Paginator->sort('user_id', 'ユーザー'); ?></li>
	</ul>
</div>

<?php foreach ($posts as $post): ?>
<div class="content">
<h3><?php echo $this->Html->link(h($post['Post']['title']), array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></h3>
<ul class="meta-list list-inline">
	<li>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
		<?php echo (empty($post['User']['username'])) ? 'Unknown' : h($post['User']['username']); ?>
	</li>
	<li>
		<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 
		<?php echo (count($post['Comment']) > 0) ? $this->Html->link('Comment(' . count($post['Comment']) . ')', array(
		'controller' => 'posts', 'action' => 'view', $post['Post']['id'], '#' => 'com')) : 'Comment(0)'; ?>
	</li>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?> / 
	<?php echo $this->Form->postLink('Delete',
								 array('action' => 'delete', $post['Post']['id']),
								 array('confirm' => 'Are you sure?')); ?>
	</li>
	<?php endif; ?>
	<li>
		Category : <?php echo h($post['Category']['name']); ?>
	</li>
	<li>
		Tag : 
	<?php foreach ($post['Tag'] as $tag): ?>
	<?php echo h($tag['name']); ?>, 
	<?php endforeach; ?>
	</li>
	<li class="date">
		<?php echo preg_replace('/ \d{2}:\d{2}:\d{2}/', '', $post['Post']['created']); ?>
	</li>
</ul>
<?php echo mb_strimwidth(h($post['Post']['body']), 0, 300, '...', 'utf-8'); ?>
</div><!-- content -->
<?php endforeach; ?>

<ul class="pager">
<?php echo $this->Paginator->prev('< prev', array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(array('separator' => '')); ?>
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>
</ul>