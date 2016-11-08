<?php

App::uses('CakeEmail', 'Network/Email');

class CommentsController extends AppController {

	public $helper = array('Html', 'Form', 'Flash');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function add($viewId) {
		if ($this->request->is('post')) {
			if ($this->Comment->save($this->request->data)) {
	            $this->Session->setFlash(__('コメントを投稿しました。'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
	            $this->__comment_notification($this->request->data['Comment']['body']);
			} else {
				$this->Session->write('errors.Comment', $this->Comment->validationErrors);
				$this->Session->setFlash(__('failed to post comments.'), 'alert', array(
	            	'plugin' => 'BoostCake',
	            	'class' => 'alert-danger'
	            ));
			}
            return $this->redirect($this->referer());
		}
	}

	public function delete($commentId, $viewId) {
		
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Comment->delete($commentId)) {
            $this->Session->setFlash(__('コメントを削除しました。'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
		} else {
			$this->Session->setFlash(__('コメントの投稿に失敗しました。'), 'alert', array(
	        	'plugin' => 'BoostCake',
	        	'class' => 'alert-danger'
	        ));
		}
		return $this->redirect(array('controller' => 'posts', 'action' => 'view', $viewId));
	}

	private function __comment_notification($comment) {
		// admin
		$this->loadModel('User');
		$admin_email = $this->User->find('first', array(
			'conditions' => array(
				'User.group_id' => 1,
				'User.id' => 1
			),
			'fields' => 'User.email'
		));
		// author
		$author_email = $this->Comment->Post->find('first', array(
			'conditions' => array(
				'Post.id' => $this->request->data['Comment']['post_id']
			),
			'fields' => 'User.email'
		));
        $email = new CakeEmail();
        $email->to(array($admin_email['User']['email'], $author_email['User']['email']));
        $email->send($comment);
	}
}