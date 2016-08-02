<h2><?php echo $post['Post']['title']; ?></h2>
<div class="well">
<?php

echo '<div class="view_cate">Category: ' . $post['Category']['name'] . '</div>';

echo '<div class="view_tag">Tag: ';
foreach ($post['Tag'] as $value) {
	echo $value['name'] . ',';
}
echo '</div>';

echo $post['Post']['body'];

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
</div><!-- well -->