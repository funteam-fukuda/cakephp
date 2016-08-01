<table class="table table-striped table-bordered">
<tr>
<th>id</th>
<th>title</th>
<th>body</th>
</tr>
<td><?php echo $post['Post']['id']; ?></td>
<td><?php echo $post['Post']['title']; ?></td>
<td>
<?php echo $post['Post']['body']; ?>

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
</td>
</table>