<?php

App::uses('AppModel', 'Model');

class Comment extends AppModel {

	public $belongsTo = 'Post';

	public $validate = array(
		'commenter' => array(
			'rule' => 'notBlank',
			'message' => 'このフィールドは必須項目です。'
		),
		'body' => array(
			'rule' => 'notBlank',
			'message' => 'このフィールドは必須項目です。'
		)
	);
}