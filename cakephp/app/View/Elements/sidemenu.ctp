<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Search Form</h3>
</div>
<div class="panel-body">
<div class="clickArea">Click Here!</div>
<div class="searchArea">
	<?php
	echo $this->Form->create('Post', array(
		'novalidate' => true,
		'url' => array_merge(array('action' => 'search'), $this->params['pass'])
		));
	echo $this->Form->input('title', array('div' => 'form-group', 'class' => 'form-control'));
	echo $this->Form->input('Post.category', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $head_categories,
		'div' => 'checkbox_wrap',
		'class' => 'checkbox'
	));
	echo $this->Form->input('Post.tag', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $head_tags,
		'div' => 'checkbox_wrap',
		'class' => 'checkbox'
	));
	echo $this->Form->submit('Search', array(
		'class' => 'btn btn-success'));
	echo $this->Form->end();
	?>
</div><!-- panel-body -->
</div><!-- panel -->
</div>

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">PostalCodeSearch</h3>
</div>
<div class="panel-body">
<?php
echo $this->Form->create('PostalCode', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'class' => 'form-control'
	),
	'url' => 'javascript:void(0)',
	'class' => 'form-inline'
	));
echo $this->Form->input('request', array(
	'label' => false));

echo $this->Form->submit('Search', array(
	'id' => 'searchZipCode', 'class' => 'btn btn-primary', 'div' => false));

echo $this->Form->input('result', array(
	'type' => 'select',
	'id' => 'result_zipcode',
	'label' => false,
	'div' => false));

echo $this->Form->end();
?>
</div><!-- panel-body -->
</div><!-- panel -->

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Tag Cloud</h3>
</div>
<div class="panel-body">
<?php foreach($head_tags as $key => $val): ?>
<?php echo $this->Html->link($val, array(
	'controller' => 'posts',
	'action' => 'search',
	'?' => array('tag[0]' => $key))) . ' ';
?>
<?php endforeach; ?>
</div><!-- panel-body -->
</div><!-- panel -->