<?php echo $this->Html->script('addformdata.js'); ?>
<?php
echo '<div id="editwrap">';
for ($i=0; $i<count($tag[0]['Tag']); $i++) {
	$tags[$tag[0]['Tag'][$i]['id']] = $tag[0]['Tag'][$i]['name'];
}
?>
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('category_id', array(
	'type' => 'select',
	'options' => $posts));
echo $this->Form->input('Tag', array(
	'type' => 'select',
	'multiple' => 'checkbox',
	'options' => $tags
	));

echo $this->Html->link('＋', 'javascript:void(0)', array(
	'id' => 'addFormData'));

echo '<div class="file"><div><input type="file" name="data[Attachment][0][photo]" id="Attachment0Photo"></div></div>';

echo $this->Form->end('Save Post');

echo '<div class="editimg">';
for ($i=0; $i<$item = count($uploads['Attachment']); $i++) {
	if ($uploads['Attachment'][$i]['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $uploads['Attachment'][$i]['photo_dir'] . '/' . $uploads['Attachment'][$i]['photo'];

		echo $this->Form->postLink(
		$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100', 'class' => 'dlt')),
		array('action' => 'delete_image', $uploads['Attachment'][$i]['photo_dir']),
		array('confirm' => 'delete it?', 'escape' => false));
	}
}
echo '</div><!-- editimg-->';
echo '</div><!-- editwrap-->';
?>