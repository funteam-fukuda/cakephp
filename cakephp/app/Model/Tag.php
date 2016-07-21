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
}