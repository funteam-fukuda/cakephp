<?php
for ($i=0; $i<count($tag[0]['Tag']); $i++) {
	$tags[$tag[0]['Tag'][$i]['id']] = $tag[0]['Tag'][$i]['name'];
}
?>

<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('category_id', array(
	'type' => 'select',
	'options' => $posts));
echo $this->Form->input('Tag', array(
	'type' => 'select',
	'multiple' => 'checkbox',
	'options' => $tags
	));
for ($i=0;$i<3;$i++) {
	echo $this->Form->input('Attachment.' . $i . '.photo', array('type' => 'file'));
	echo $this->Form->input('Attachment.' . $i . '.photo_dir', array('type' => 'hidden'));
}
echo $this->Form->end('Save Post');
?>