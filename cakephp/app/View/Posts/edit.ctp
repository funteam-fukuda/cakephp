<?php echo $this->Html->script('addformdata.js'); ?>
<div id="editwrap">

<?php $this->Html->addCrumb('Edit'); ?>

<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title', array('class' => 'form-control', 'div' => 'form-group'));
echo $this->Form->input('body', array('rows' => '3', 'class' => 'form-control', 'div' => 'form-group'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('category_id', array(
	'class' => 'form-control',
	'div' => 'form-group',
	'type' => 'select',
	'options' => $posts));

echo $this->Form->input('Tag', array(
	'div' => 'checkbox_wrap',
	'type' => 'select',
	'multiple' => 'checkbox',
	'options' => $tag
	));

echo '<div id="regist_img"></div>';

echo '<div id="addimg"></div>';
?>

<div id="uploadform">

<div class="upitem">
<input id="lefile1" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover" class="form-control upimg1" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile1&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

</div><!-- uploadform -->

<?php

echo $this->Form->end(array('name' => 'Save Post', 'class' => 'btn btn-success btn-block btn-lg'));

echo '<div class="editimg well">';
for ($i=0; $i<$item = count($uploads['Attachment']); $i++) {
	if ($uploads['Attachment'][$i]['photo_dir'] != '') {
		$imgurl = '/files/attachment/photo/' . $uploads['Attachment'][$i]['photo_dir'] . '/' . $uploads['Attachment'][$i]['photo'];

		echo $this->Form->postLink(
		$this->Html->image($imgurl,
			array('width' => '100', 'height' => '100', 'class' => 'dlt img-thumbnail')),
		array('action' => 'delete_image', $uploads['Attachment'][$i]['photo_dir']),
		array('confirm' => 'delete it?', 'escape' => false));
	}
}
echo '</div><!-- editimg-->';
echo '</div><!-- editwrap-->';
?>