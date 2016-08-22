<?php
$this->Html->addCrumb('Post', '/');
$this->Html->addCrumb('Add Post');
?>

<legend>Add Post</legend>
<?php
echo $this->Form->create('Post', array('type' => 'file', 'novalidate' => true));
echo $this->Form->input('title', array('class' => 'form-control', 'div' => 'form-group'));
echo $this->Form->input('body', array('rows' => '3', 'class' => 'form-control', 'div' => 'form-group'));
echo $this->Form->input('category_id', array(
	'type' => 'select',
	'div' => 'form-group',
	'class' => 'form-control',
	'options' => $head_categories));

echo $this->Form->input('Tag', array(
	'div' => 'checkbox_wrap',
	'type' => 'select',
	'multiple' => 'checkbox',
	'options' => $head_tags
	));

if (!empty($tag_error)) {
	echo '<div class="error-message tagerr">';
	echo $tag_error[0];
	echo '</div>';
}

?>

<?php
for ($i=0;$i<3;$i++) {
	$file = <<< EOF

<div class="upitem">
<input id="lefile{$i}" name="data[Attachment][{$i}][photo]" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover{$i}" class="form-control upimg{$i}" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile{$i}&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile{$i}]').change(function() {
    $('#photoCover{$i}').val($(this).val());
  });
</script>

EOF;

echo $file;
}
?>

<?php 

if (!empty($img_error)) {
	echo '<div class="error-message imgerr">';
	foreach ($img_error as $value) {
		echo $value['photo'][0];
		echo '</div>';
	}
}

echo $this->Form->end(array('name' => 'Save Post', 'class' => 'btn btn-success btn-block btn-lg'));
?>