<?php

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
			} else {
				$this->Session->write('errors.Comment', $this->Comment->validationErrors);
				$this->Session->setFlash(__('failed to post comments.'), 'alert', array(
	            	'plugin' => 'BoostCake',
	            	'class' => 'alert-danger'
	            ));
			}
            return $this->redirect($this->referer());
            //return $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->request->data['Comment']['post_id']));
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
}