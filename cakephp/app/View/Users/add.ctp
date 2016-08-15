<div class="users form">
<?php echo $this->Form->create('User', array(
	'class' => 'form-group', 'novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php
		echo $this->Form->input('username', array(
			'class' => 'form-control',
			'div' => 'form-group'));
		echo $this->Form->input('password', array(
			'class' => 'form-control',
			'div' => 'form-group'));
		echo $this->Form->input('password_confirm', array(
			'class' => 'form-control', 'div' => 'form-group', 'label' => 'パスワード(再入力)', 'type' => 'password'));
		echo $this->Form->input('group_id', array(
			'class' => 'form-control',
			'div' => 'form-group'));
		$options = array(
		'label' => 'Submit',
		'div' => false,
		'class' => 'btn btn-success btn-block');
		echo $this->Form->end($options);
		?>
	</fieldset>
</div>