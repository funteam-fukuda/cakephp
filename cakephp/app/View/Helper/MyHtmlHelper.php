<?php

class MyHtmlHelper extends HtmlHelper {

	public $helpers = array('Permission');

	public function link($title, $url = null, $options = array(), $confirmMessage = false) {
		$options = array_merge(array(
			'escape' => false
		), $options);
		$url = ($url != null) ? $url : $title;

		if ($this->Permission->check($url)) {
			return parent::link($title, $url, $options, $confirmMessage);
		}
		return null;
 	}
}