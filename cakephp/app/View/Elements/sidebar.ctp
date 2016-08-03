<div class="page-main">
	<aside>
		<div id="sidebar_contents">

			<?php
			echo $this->Form->create('PostalCode', array(
				'url' => 'javascript:void(0)'));
			echo $this->Form->input('request', array(
				'label' => 'PostalCodeSearch',
				'class' => 'postalcodeform'));

			echo $this->Form->input('result', array(
				'type' => 'select',
				'id' => 'result_zipcode',
				'label' => false));

			echo $this->Form->submit('Search', array(
				'id' => 'searchZipCode', 'class' => 'btn'));
			echo $this->Form->end();
			?>

			<button><img src="http://blog.dev/cakephp/img/btn_open.png"></button>
		</div>
	</aside>
</div>