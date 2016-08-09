<?php $this->Html->addCrumb('Search'); ?>

<p>検索結果は<?php echo (!empty($posts)) ? count($posts) : 0; ?>件です。</p>
<?php if(!empty($posts)): ?>
<?php foreach ($posts as $post): ?>
<div class="content">
<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></h3>
<ul class="meta-list list-inline">
	<li>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
		<?php echo (empty($post['User']['username'])) ? 'Unknown' : $post['User']['username']; ?>
	</li>
	<li>
		Category : <?php echo $post['Category']['name']; ?>
	</li>
	<li>
		Tag : 
	<?php foreach ($post['Tag'] as $tag): ?>
	<?php echo $tag['name']; ?>, 
	<?php endforeach; ?>
	</li>
	<li class="date">
		<?php echo preg_replace('/ \d{2}:\d{2}:\d{2}/', '', $post['Post']['created']); ?>
	</li>
</ul>
<?php echo mb_strimwidth($post['Post']['body'], 0, 300, '...', 'utf-8'); ?>
</div><!-- content -->
<?php endforeach; ?>
<?php endif; ?>