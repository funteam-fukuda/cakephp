<?php

App::uses('ApppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $actsAs = array('Acl' => array('type' => 'requester'));

	public $validate = array(
		'username' => array(
			array(
				'rule' => array('notBlank'),
				'message' => 'このフィールドは入力必須です。',
			),
			array(
				'rule' => array('between', 4, 8),
				'message' => '4文字以上、8文字以下で入力して下さい。',
				'last' => true
			)
		),
		'password' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'このフィールドは入力必須です。'
			),
			array(
				'rule' => array('between', 6, 12),
				'message' => '6文字以上、12文字以下で入力して下さい。',
				'last' => true
			)
		),
		'password_confirm' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'このフィールドは入力必須です。'
			),
			'compare' => array(
				'rule' => array('password_match', 'password'),
				'message' => 'パスワードが一致しません'
			),
			'length' => array(
				'rule' => array('between', 6, 12),
				'message' => '6文字以上、12文字以下で入力して下さい。'
			)
		)
	);

	public function password_match($field, $password) {
		return ($field['password_confirm'] === $this->data[$this->name][$password]);
	}

	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}

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
    
    /*public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
          $this->data['User']['password']
        );
        return true;
    }*/

    /*public function bindNode($user) {
    	return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }*/
}