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
	'options' => $posts));

echo $this->Form->input('Tag', array(
	'div' => 'checkbox_wrap',
	'type' => 'select',
	'multiple' => 'checkbox',
	'options' => $tag
	));

if (!empty($tag_error)) {
	echo '<div class="error-message tagerr">';
	echo $tag_error[0];
	echo '</div>';
}

?>

<div class="upitem">
<input id="lefile1" name="data[Attachment][1][photo]" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover1" class="form-control upimg1" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile1&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile1]').change(function() {
    $('#photoCover1').val($(this).val());
  });
</script>

<div class="upitem">
<input id="lefile2" name="data[Attachment][2][photo]" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover2" class="form-control upimg2" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile2&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile2]').change(function() {
    $('#photoCover2').val($(this).val());
  });
</script>

<div class="upitem">
<input id="lefile3" name="data[Attachment][3][photo]" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover3" class="form-control upimg3" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile3&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile3]').change(function() {
    $('#photoCover3').val($(this).val());
  });
</script>

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