<?php

App::uses('AppController', 'Controller');

class GroupsController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();

		//$this->Auth->allow();
	}

	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
	            $this->Session->setFlash(__('The group has been saved.'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
				return $this->redirect(array('action' => 'index'));
			}
            $this->Session->setFlash(__('The group could not be saved. Please, try again.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect(array('action' => 'index'));
		}
	}

	public function edit() {
		$this->set('groups', $this->Paginator->paginate());
		if ($this->request->is('post')) {
			$result = $this->Group->find('first', array(
			'conditions' => array(
				'name' => $this->request->data['Group']['name'])));
			if (empty($result)) {
				if ($this->Group->save($this->request->data)) {
		            $this->Session->setFlash(__('success!'), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-success'
		            ));
				} else {
		            $this->Session->setFlash(__('error!' . __line__), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-danger'
		            ));
				}
				$this->redirect(array('action' => 'edit'));
			} else {
	            $this->Session->setFlash(__('この名前は既に使用中です。'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
				$this->redirect(array('action' => 'edit'));
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$result = $this->Group->User->find('first', array(
			'conditions' => array(
				'group_id' => $id)));
		if (empty($result)) {
			if ($this->Group->delete($id)) {
	            $this->Session->setFlash(__('success!'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
			} else {
	            $this->Session->setFlash(__('error!' . __line__), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
			}
			$this->redirect(array('action' => 'index'));
		} else {
            $this->Session->setFlash(__('このグループに属しているユーザーが存在する為削除できません。'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
			$this->redirect(array('action' => 'index'));
		}
	}
}