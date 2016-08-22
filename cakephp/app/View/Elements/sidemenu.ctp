<div class="panel panel-default" style="border-radius:0;">
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
	echo $this->Form->input('search_title', array('div' => 'form-group', 'class' => 'form-control'));
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
</div><!-- searchArea -->
</div><!-- panel-body -->
</div><!-- panel -->

<div class="panel panel-default" style="border-radius:0;">
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

<div class="panel panel-default" style="border-radius:0;">
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

<div class="panel panel-default" style="border-radius:0;">
<div class="panel-heading">
<h3 class="panel-title">Recent Comments</h3>
</div>
<div class="panel-body">
<div id="recent_comments">
<ul>
<?php foreach($recent_comments as $key => $val): ?>
	<li>
		<dl>
			<dt><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo h($val['Comment']['commenter']); ?> 
<span class="recent-title"> on <?php echo $this->Html->link(h($val['Post']['title']), array('controller' => 'posts', 'action' => 'view', $val['Post']['id'])); ?> - <span class="recente-create"><?php echo $this->Common->convert_to_fuzzy_time($val['Comment']['created']); ?></span></span>
			</dt>
			<dd><?php echo mb_strimwidth(h($val['Comment']['body']), 0, 100, '...', 'utf-8'); ?></dd>
		</dl>
	</li>
<?php endforeach; ?>
</ul>
</div><!-- recent_comments -->
</div><!-- panel-body -->
</div><!-- panel -->

<div class="panel panel-default" style="border-radius:0;">
<div class="panel-heading">
<h3 class="panel-title">Archives</h3>
</div>
<div class="panel-body">
<div id="recent_comments">
<ul>
<?php foreach($archive as $key => $val): ?>
	<li class="archive-li">
	<?php
		$date_list = split('/', $val[0]['time']);
		echo $this->Html->link($val[0]['time'], array('controller' => 'posts', 'action' => 'archives', $date_list[0], $date_list[1]));
	?>
	<?php echo '(' . $val[0]['count'] . ')'; ?>
	</li>
<?php endforeach; ?>
</ul>
</div><!-- recent_comments -->
</div><!-- panel-body -->
</div><!-- panel -->