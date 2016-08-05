<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
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
?>

<div class="upitem">
<input id="lefile1" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover" class="form-control upimg1" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile1&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile1]').change(function() {
    $('#photoCover').val($(this).val());
  });
</script>

<div class="upitem">
<input id="lefile2" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover" class="form-control upimg2" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile2&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile2]').change(function() {
    $('#photoCover').val($(this).val());
  });
</script>

<div class="upitem">
<input id="lefile3" type="file" style="display:none">
<div class="input-group">
<input type="text" id="photoCover" class="form-control upimg3" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-info" onclick="$('input&#91;id=lefile3&#93;').click();">
<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
</button></span>
</div>
</div><!-- upitem -->

<script>
  $('input[id=lefile3]').change(function() {
    $('#photoCover').val($(this).val());
  });
</script>

<?php echo $this->Form->end(array('name' => 'Save Post', 'class' => 'btn btn-success btn-block btn-lg')); ?>