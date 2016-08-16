<?php

App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

	public $components = array('Paginator');

	public function index() {

		$this->set('categories', $this->Paginator->paginate());

		if ($this->request->is(array('post', 'put'))) {
			// validation
			foreach ($this->request->data['Category'] as $key => $value) {
				$this->Category->set(array('Category' => $value));

				if (!$this->Category->validates()) {
					$errors = $this->Category->validationErrors;
					foreach ($errors as $field => $error) {
						$out[$key][$field] = $error[0];
					}
					$flag = true;
				}
			}
			// set error msg
			if (isset($flag)) {
				unset($out['id']);
				$this->set('out', $out);
			}
			
			if ($this->Category->save($this->request->data)) {
	            $this->Session->setFlash(__('success!'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
	            return $this->redirect(array('action' => 'index'));
			}

            $this->Session->setFlash(__('登録に失敗しました。'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			// validation
			foreach ($this->request->data['Category'] as $key => $value) {
				$this->Category->set(array('Category' => $value));
				if (!$this->Category->validates()) {
					$this->Category->validationErrors = array(0 => $this->Category->validationErrors);
					$this->Session->write('errors.Category', $this->Category->validationErrors);
				}
			}
			if ($this->Category->save($this->request->data)) {
	            $this->Session->setFlash(__('success!'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
	            return $this->redirect(array('action' => 'index'));
			}

            $this->Session->setFlash(__('error!' . __line__), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
            return $this->redirect($this->referer());
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