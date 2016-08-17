<?php
$this->Html->addCrumb('Post', '/');
$this->Html->addCrumb(h($post['Post']['title']));
?>

<div class="content">
<h3 class="view_h3"><?php echo h($post['Post']['title']); ?></h3>
<ul class="meta-list list-inline">
	<li>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
		<?php echo (empty($post['User']['username'])) ? 'Unknown' : h($post['User']['username']); ?>
	</li>
	<li>
		Category : <?php echo h($post['Category']['name']); ?>
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
<?php echo nl2br(h($post['Post']['body'])); ?>

<?php
echo '<div class="view-imgwrap" id="' . $post['Post']['id'] . '">';
$cnt = 0;
foreach ($post['Attachment'] as $value) {
	if ($value['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $value['photo_dir'] . '/' . $value['photo'];
		echo $this->Html->link(
			$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100', 'class' => 'img-thumbnail imgthumb dlt')),
			'javascript:void(0)',
			array('escape' => false, 'data-target' => 'con1', 'class' => "modal-open $cnt")
		);
		$cnt++;
	}
}
echo '</div>';
?>

</div><!-- content -->

<legend id="com">Comments</legend>
<?php foreach ($post['Comment'] as $key => $value): ?>
	<ul class="ul-comment">
		<dl class="well">
		<li>
		<dt><?php echo $key + 1 . '.　名前 : ' . h($value['commenter']); ?>
		<?php echo '投稿日 : ' . $value['created']; ?>
		<?php if($login['Group']['name'] == 'administrators'): ?>
		<span>
			<?php echo $this->Form->postLink('削除',
								 array('controller' => 'comments', 'action' => 'delete', $value['id'], $post['Post']['id']),
								 array('class' => 'btn btn-danger btn-xs'),
								 'このコメントを削除しても良いですか？'); ?>
		</span>
		<?php endif; ?>
		</dt>
		</li>
		<li><dd class="comment-body"><?php echo h($value['body']); ?></dd></li>
		</dl>
	</ul>
<?php endforeach; ?>

<?php
echo $this->Form->create('Comment', array(
	'url' => array('controller' => 'comments', 'action' => 'add'),
	'novalidate' => true,
	'class' => 'form-group'));
echo $this->Form->input('commenter', array(
	'class' => 'form-control', 'div' => 'form-group', 'label' => '名前'));
echo $this->Form->input('body', array(
	'rows' => 3, 'class' => 'form-control', 'div' => 'form-group', 'label' => 'コメント'));
echo $this->Form->hidden('post_id', array(
	'value' => $post['Post']['id']));
$options = array(
	'label' => 'コメントを投稿する',
	'div' => false,
	'class' => 'btn btn-success btn-block');
echo $this->Form->end($options);
?>