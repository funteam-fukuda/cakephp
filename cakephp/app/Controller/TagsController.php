<?php

App::uses('AppController', 'Controller');

class TagsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->set('tags', $this->Paginator->paginate());

		if ($this->request->is('post')) {
			$result = $this->Tag->find('list', array(
				'conditions' => array('name' => $this->request->data['Tag']['name'])));
			if (empty($result)) {
				if ($this->Tag->save($this->request->data)) {
					$this->Flash->success(__('success'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('error'));
			} else {
				$this->Flash->error(__('既に使用されている名前です'));
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$result = $this->Tag->PostsTag->find('list', array(
			'conditions' => array('tag_id' => $id)));
		if (empty($result)) {
			$this->Tag->delete($id);
			$this->Flash->success(__('success'));
		} else {
			$this->Flash->error(__('このタグは使用中です'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function add()
}