<div class="clickArea">Search Form</div>
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
</div>