<?php $this->Html->addCrumb('View'); ?>

<div class="content">
<h3><?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></h3>
<ul class="meta-list list-inline">
	<li>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $post['User']['username']; ?> 
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
<?php echo $post['Post']['body']; ?>

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