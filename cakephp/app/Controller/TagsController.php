<?php

App::uses('AppController', 'Controller');

class TagsController extends AppController {

	public $components = array('Paginator');

	public function index() {

		$this->set('tags', $this->Paginator->paginate());

		if ($this->request->is(array('post', 'put'))) {
			// validation
			foreach ($this->request->data['Tag'] as $key => $value) {
				$this->Tag->set(array('Tag' => $value));

				if (!$this->Tag->validates()) {
					$errors = $this->Tag->validationErrors;
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

		if ($this->request->is(array('post', 'put'))) {
			// validation
			foreach ($this->request->data['Tag'] as $key => $value) {
				$this->Tag->set(array('Tag' => $value));
				if (!$this->Tag->validates()) {
					$this->Tag->validationErrors = array(0 => $this->Tag->validationErrors);
					$this->Session->write('errors.Tag', $this->Tag->validationErrors);
				}
			}
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
            return $this->redirect($this->referer());
		}
	}
}