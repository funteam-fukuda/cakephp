<?php
$this->Html->addCrumb('Group', '/groups');
$this->Html->addCrumb('Add Group');
?>

<div class="groups form">
<?php echo $this->Form->create('Group', array(
	'class' => 'form-group', 'novalidate' => true)); ?>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name', array(
			'class' => 'form-control',
			'div' => 'form-group'));
		$options = array(
		'label' => 'Submit',
		'div' => false,
		'class' => 'btn btn-success btn-block');
		echo $this->Form->end($options);
	?>
</div>