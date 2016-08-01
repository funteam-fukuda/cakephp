<div class="clickArea">Search Form</div>
<div class="searchArea">
	<?php
	echo $this->Form->create('Post', array(
		'novalidate' => true,
		'url' => array_merge(array('action' => 'search'), $this->params['pass'])
		));
	echo $this->Form->input('title', array('div' => false));
	echo $this->Form->input('Post.category', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $categories,
		'div' => false,
		'class' => 'checkbox inline'
	));
	echo $this->Form->input('Post.tag', array(
		'type' => 'select',
		'multiple' => 'checkbox',
		'options' => $tags,
		'div' => false,
		'class' => 'checkbox inline'
	));
	echo $this->Form->submit('Search', array(
		'class' => 'btn'));
	echo $this->Form->end();
	?>
</div>