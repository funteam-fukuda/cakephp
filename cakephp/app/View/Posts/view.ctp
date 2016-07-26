<?php echo $this->Html->script('searchform.js?'); ?>
<?php echo $this->Html->script('slideshow.js'); ?>
<?php echo $this->Html->css('cake.user'); ?>
<table>
<tr>
<th>id</th>
<th>title</th>
<th>body</th>
</tr>

<tr>
<td><?php echo $post['Post']['id']; ?></td>
<td><?php echo $post['Post']['title']; ?></td>
<td><?php echo $post['Post']['body']; ?></td>
<td>
<?php
echo '<div id="' . $post['Post']['id'] . '">';
for ($i=0;$i<count($post['Attachment']);$i++) {
	if ($post['Attachment'][$i]['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $post['Attachment'][$i]['photo_dir'] . '/' . $post['Attachment'][$i]['photo'];
		echo $this->Html->link(
			$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100')),
			'javascript:void(0)',
			array('escape' => false, 'data-target' => 'con1', 'id' => $i, 'class' => "modal-open $i")
		);
	}
}
echo '</div>';
?>
</td>
</tr>

</table>