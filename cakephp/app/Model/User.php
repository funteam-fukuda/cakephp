<?php

App::uses('ApppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A password is required'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'author')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);

	// モデルのデータがバリデーションに成功した後、 データが保存される前に実行される
	public function beforeSave($options = array()) {
		// 平文pwのhash化
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		// trueを返すことでsave処理を継続
		return true;
	}
}