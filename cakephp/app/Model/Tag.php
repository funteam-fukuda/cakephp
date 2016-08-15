<?php

class Tag extends AppModel {

	public $name = 'Tag';

	public $hasAndBelongsToMany = array(
		'Post' =>
			array(
				'className'				=> 'Post',
				'joinTable'				=> 'posts_tags',
				'foreignKey'			=> 'tag_id',
				'associationForeignKey'	=> 'post_id',
				'unique'				=> false,
				'conditions'			=> '',
				'fields'				=> '',
				'order'					=> '',
				'limit'					=> '',
				'offset'				=> '',
				'finderQuery'			=> '',
				'deleteQuery'			=> '',
				'insertQuery'			=> '',
				'with'					=> 'PostsTag'
			)
	);

	public $validate = array(
		'name' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'このフィールドは入力必須です。'
			),
			array(
				'rule' => 'isUnique',
				'message' => 'このタグは既に存在しています。'
			)
		)
	);
}