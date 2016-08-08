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
				$this->Flash->success(__('The group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('The group could not be saved. Please, try again.'));
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
					$this->Flash->success(__('success!'));
				} else {
					$this->Flash->error(__('error!' . __line__));
				}
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('この名前は既に使用中です。'));
				$this->redirect(array('action' => 'index'));
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
				$this->Flash->success(__('success!'));
			} else {
				$this->Flash->error(__('error!' . __line__));
			}
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('このグループに属しているユーザーが存在する為削除できません。'));
			$this->redirect(array('action' => 'index'));
		}
	}
}