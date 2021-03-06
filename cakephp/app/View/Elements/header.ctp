<nav class="collapse navbar-collapse">
	<ul class="nav navbar-nav">
	<li>
	<?php echo $this->Html->link(
	'Home', array('controller' => 'posts', 'action' => 'index'));
	?>
	</li>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->Html->link(__('AddPost'), array(
		'controller' => 'posts', 'action' => 'add'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->MyHtml->link(__('User'), array(
		'controller' => 'users', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->MyHtml->link(__('Group'), array(
		'controller' => 'groups', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->MyHtml->link(__('Tag'), array(
		'controller' => 'tags', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>
	<?php if (!is_null($login)): ?>
	<li>
	<?php echo $this->MyHtml->link(__('Category'), array(
		'controller' => 'categories', 'action' => 'index'));
	?>
	</li>
	<?php endif; ?>

	<?php if (!is_null($login)): ?>
		<li style="color:#9d9d9d;position:absolute;top:8px;right:10px;">
		<div class="btn-group">
			<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<?php echo 'こんにちは、' . $login['username'] . 'さん!'; ?>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<li role="presentation"><?php echo $this->Html->link('Logout', array(
					'controller' => 'users', 'action' => 'logout')); ?></li>
			</ul>
		</div>
		</li>
	<?php else: ?>
		<li style="color:#9d9d9d;position:absolute;top:0;right:10px;">
		<?php echo $this->Html->link(__('Login'), array(
			'controller' => 'users', 'action' => 'login'));?>
		</li>
	<?php endif; ?>
	</ul>
</nav>