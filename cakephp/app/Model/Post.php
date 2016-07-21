<?php

class Post extends AppModel	{

	public $actsAs = array('Search.Searchable');

	public $validate = array(
		'title' => array(
			'rule' => 'notBlank'
		),
		'body' => array(
			'rule' => 'notBlank'
		)
	);

	public function post_pagenate() {
		$option = array(
			'limit' => 3
		);
		return $option;
	}

	/*
	public function beforeSave($options = array()) {
		debug($this->data);
		$attach_cnt = count($this->data['Attachment']);
		for ($i=0;$i<$attach_cnt;$i++) {
			if ($this->data['Attachment'][$i]['Attachment']['photo']['error'] == 4) {
				unset($this->data['Attachment'][$i]);
			}
		}
		debug($this->data);
		return true;
	}*/

	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) != false;
	}

	// category
	// postsは外部キーを含むので、usersに属している
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id'
		)
	);
	// Upload
	public $hasMany = array(
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'post_id'
		)
	);

	// tag
	public $name = 'Post';
	public $hasAndBelongsToMany = array(
		'Tag' =>
			array(
				'className'				=> 'Tag',
				'joinTable'				=> 'posts_tags',
				'foreignKey'			=> 'post_id',
				'associationForeignKey'	=> 'tag_id',
				'unique'				=> true,
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

	// Search
	// 検索条件を設定するプロパティ
	// name どのフォーム値を, field どのフィールドに対して, type どのような方法で行うか　を定義する
	// filed = フォーム値と連動するフィールドの値を指定してあげる
	// method: "expression", "subquery", "query"では必須
	// type: value(int)=完全一致, like(string)=部分一致
	public $filterArgs = array(
		array('name' => 'title', 'type' => 'like'),
		'tag' => array('type' => 'subquery', 'method' => 'searchTag', 'field' => 'Post.id'),
		'category' => array('field' => 'Post.category_id', 'type' => 'value')
	);

	// tag search
	
	// @query
	// select post_id from posts inner join posts_tags on posts.id = posts_tags.post_id where posts_tags.tag_id = 1;
	function searchTag($data = array()) {
		$cond = array_values($data['tag']);
		$query = $this->PostsTag->find('all', array(
			// SQLのwhere句に該当
			'conditions' => array('PostsTag.tag_id' => $cond),
			#'group' => 'PostsTag.tag_id HAVING COUNT(PostsTag.tag_id) = ' . count($cond),
			// 取得するフィールドの列選択
			'fields' => 'post_id'
			#'contain' => array('Tag')
			)
		);
		for($i=0;$i<count($query);$i++) {
			$buf[] = $query[$i]['PostsTag']['post_id'];
		}
		$buf = implode(',', $buf);
		return $buf;
	}
}