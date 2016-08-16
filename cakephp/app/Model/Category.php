<?php

App::uses('AppModel', 'Model');

class Category extends AppModel {

	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $validate = array(
		'name' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'このフィールドは入力必須です。'
			),
			array(
				'rule' => 'isunique',
				'message' => 'このカテゴリは既に存在しています。'
			)
		)
	);
}