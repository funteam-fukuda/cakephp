<?php

App::uses('Component', 'Controller');

class PermissionComponent extends Component {
	
	public $components = array('Session', 'Auth', 'Acl');

	public function init() {
		$this->clear();
		// users.id => aros.foreign_key
		$aro = $this->Acl->Aro->find('first', array(
			'conditions' => array(
				'Aro.model' => 'User',
				'Aro.foreign_key' => $this->Auth->user('id')
			)
		));

		// 該当ユーザーのaros, acos, aros_acosを全件取得
		$permissions = $this->Acl->Aro->Permission->find('all', array(
			'conditions' => array(
				'Permission.aro_id' => $aro['Aro']['id']
			)
		));

		foreach ($permissions as $p) {
			if ($p['Permission']['_create'] == 1 && $p['Permission']['_read'] == 1 &&
				$p['Permission']['_update'] == 1 && $p['Permission']['_delete'] == 1) {
				$allow = true;
			} else {
				$allow = false;
			}
			// acos.alias => controllers
			// admin以外はfalseが書き込まれる
			if (!empty($p['Aco']['alias']) && $p['Aco']['alias'] == 'controllers') {
				$this->Session->write('Auth.Permissions.controllers', $allow);
			} elseif (!empty($p['Aco']['parent_id'])) {
				$parent = $this->Acl->Aco->findById($p['Aco']['parent_id']);
				$key = 'Auth.Permissions.' . $parent['Aco']['alias'] . '.' . $p['Aco']['alias'];
				// usersの場合
				// 'Auth.Permissions.controllers.Upload'
				// 'Auth.Permissions.controllers.Posts'
				$this->Session->write($key, $allow);
			}
		}
	}

	public function clear() {
		$this->Session->delete('Auth.Permissions');
	}
}