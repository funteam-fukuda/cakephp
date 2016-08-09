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
		            $this->Session->setFlash(__('success!'), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-success'
		            ));
				} else {
		            $this->Session->setFlash(__('登録に失敗しました。'), 'alert', array(
		                'plugin' => 'BoostCake',
		                'class' => 'alert-danger'
		            ));
		        }
		        return $this->redirect(array('action' => 'index'));
		    } else {
	            $this->Session->setFlash(__('既に登録されています。'), 'alert', array(
                	'plugin' => 'BoostCake',
                	'class' => 'alert-danger'
            	));
				return $this->redirect(array('action' => 'index'));
		    }
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			$result = $this->Category->find('first', array(
				'conditions' => array('name' => $this->request->data['Category']['name'])));
			if (empty($result)) {
				if ($this->Category->save($this->request->data)) {
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
		        return $this->redirect(array('action' => 'index'));
			} else {
	            $this->Session->setFlash(__('既に登録されています。'), 'alert', array(
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
		$result = $this->Category->Post->find('first', array(
			'conditions' => array('category_id' => $id)));
		if (empty($result)) {
			if ($this->Category->delete($id)) {
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
			return $this->redirect(array('action' => 'index'));
		} else {
            $this->Session->setFlash(__('記事と紐付いているためカテゴリを削除できません'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
			return $this->redirect(array('action' => 'index'));
		}
	}
}