<nav class="collapse navbar-collapse">
	<ul class="nav navbar-nav">
	<li>
	<?php echo $this->Html->link(
	'Home', array('controller' => 'posts', 'action' => 'index'));
	?>
	</li>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'AddPost', array('controller' => 'posts', 'action' => 'add'));
	?>
	</li>
	<?php endif; ?>
	<li>
	<?php if (!is_null($login)): ?>
	<?php echo $this->Html->link(
	'User', array('controller' => 'users', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'Group', array('controller' => 'groups', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'Tag', array('controller' => 'tags', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'Category', array('controller' => 'categories', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'Login', array('controller' => 'users', 'action' => 'login'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(
	'Logout', array('controller' => 'users', 'action' => 'logout'));
	?>
	</li>
	<?php endif; ?>
	</ul>
</nav>