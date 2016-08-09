<?php

App::uses('AppController', 'Controller');

class TagsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->set('tags', $this->Paginator->paginate());

		if ($this->request->is('post')) {
			$result = $this->Tag->find('first', array(
				'conditions' => array('name' => $this->request->data['Tag']['name'])));
			if (empty($result)) {
				if ($this->Tag->save($this->request->data)) {
		            $this->Session->setFlash(__('success!'), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-success'
		            ));
					return $this->redirect(array('action' => 'index'));
				}
	            $this->Session->setFlash(__('error!'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
			} else {
	            $this->Session->setFlash(__('既に使用されている名前です。'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
	            return $this->redirect(array('action' => 'index'));
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$result = $this->Tag->PostsTag->find('first', array(
			'conditions' => array('tag_id' => $id)));
		if (empty($result)) {
			$this->Tag->delete($id);
            $this->Session->setFlash(__('success!'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
		} else {
            $this->Session->setFlash(__('このタグは使用中です。'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function add() {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->request->is('post')) {
			$result = $this->Tag->find('first', array(
				'conditions' => array('name' => $this->request->data['Tag']['name'])));
			if (empty($result)) {
				if ($this->Tag->save($this->request->data)) {
		            $this->Session->setFlash(__('success!'), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-success'
		            ));
					return $this->redirect(array('action' => 'index'));
				}
	            $this->Session->setFlash(__('error! ' . __line__ . 'line'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
			} else {
	            $this->Session->setFlash(__('このタグは既に存在しています。'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}