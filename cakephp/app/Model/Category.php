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
			'rule1' => array(
				'rule' => 'notBlank',
				'message' => 'このフィールドは入力必須です。'
			),
			'rule2' => array(
				'rule' => 'isunique',
				'message' => '既にこのカテゴリは存在します。'
			)
		)
	);
}