<?php

App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->set('categories', $this->Paginator->paginate());

		if ($this->request->is('post')) {
			$result = $this->Category->find('first', array(
				'conditions' => array('name' => $this->request->data['Category']['name'])));
			if (empty($result)) {
				if ($this->Category->save($this->request->data)) {
					$this->Flash->success(__('name changed'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('error'));
			} else {
				$this->Flash->error(__('既に使用されている名前です'));
			}
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			$result = $this->Category->find('first', array(
				'conditions' => array('name' => $this->request->data['Category']['name'])));
			if (empty($result)) {
				if ($this->Category->save($this->request->data)) {
					$this->Flash->success(__('success!'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('error'));
			} else {
				$this->Flash->error(__('既に登録されています'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();			
		}
		$result = $this->Category->Post->find('first', array(
			'conditions' => array('category_id' => $id)));
		if (empty($result)) {
			if ($this->Category->delete($id)) {
				$this->Flash->success(__('success'));
			} else {
				$this->Flash->error(__('error'));
			}
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('記事と紐付いているためカテゴリを削除できません'));
			return $this->redirect(array('action' => 'index'));
		}
	}
}