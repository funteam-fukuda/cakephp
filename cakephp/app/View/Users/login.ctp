<?php $this->Html->addCrumb('User'); ?>

<legend>Login</legend>
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    ),
    'class' => 'well form-group'
));
echo $this->Form->input('User.username', array(
	'class' => 'form-control', 'div' => 'form-group'));
echo $this->Form->input('User.password', array(
	'class' => 'form-control', 'div' => 'form-group'));
$options = array(
	'label' => 'Login',
	'div' => false,
	'class' => 'btn btn-success btn-block');
echo $this->Form->end($options);
?>