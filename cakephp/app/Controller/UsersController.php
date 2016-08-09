<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Paginator');

	// ページにアクセスする前に実行される。ユーザー権限の検査など
	public function beforeFilter() {
		parent::beforeFilter();
		// addページ、logoutページは認証外とする
		$this->Auth->allow('add', 'logout');
		//$this->Auth->allow('initDB');
	}

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
	            $this->Session->setFlash(__('The user has been saved'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-success'
	            ));
				return $this->redirect(array('action' => 'index'));
			}
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
		}

		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	/*public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->requeset->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
		}
	}*/

	public function edit() {
		$this->set('users', $this->Paginator->paginate());
		if ($this->request->is('post')) {
			$result = $this->User->find('first', array(
			'conditions' => array(
				'username' => $this->request->data['User']['username'])));
			if (empty($result)) {
				if ($this->User->save($this->request->data)) {
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
	            $this->Session->setFlash(__('この名前は既に使用されています。'), 'alert', array(
	                'plugin' => 'BoostCake',
	                'class' => 'alert-danger'
	            ));
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->User->delete($id)) {
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
		return $this->redirect(array('action' => 'index'));
	}

	/*public function initDB() {
		$group = $this->User->Group;
		// admin
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		// manager
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');

		// user
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts/add');
		$this->Acl->allow($group, 'controllers/Posts/edit');

		echo 'All done';
		exit;
	}*/
}