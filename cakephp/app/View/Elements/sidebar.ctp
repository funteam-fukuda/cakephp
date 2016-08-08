<div class="page-main">
	<aside>
		<div id="sidebar_contents">

			<?php
			echo $this->Form->create('PostalCode', array(
				'url' => 'javascript:void(0)', 'class' => 'form-search postform-wrap'));
			echo $this->Form->input('request', array(
				'label' => 'PostalCodeSearch',
				'class' => 'postalcodeform form-control',
				'div' => false));

			echo $this->Form->submit('Search', array(
				'id' => 'searchZipCode', 'class' => 'btn btn-primary', 'div' => false));

			echo $this->Form->input('result', array(
				'type' => 'select',
				'id' => 'result_zipcode',
				'label' => false,
				'div' => false));

			echo $this->Form->end();
			?>

			<button id="open_btn"><img src="http://blog.dev/cakephp/img/btn_open.png"></button>
		</div>
	</aside>
</div>