<?php

class PermissionHelper extends AppHelper {

	public $helpers = array('Session');

	public function check($path) {
		if (!is_array($path)) {
			$path = Router::parse($path);
		}
		if (empty($path['controller'])) {
			$path['controller'] = $this->params['controller'];
		}
		if (empty($path['action'])) {
			$path['action'] = 'index';
		}
		// 権限があればtrueを返す、なければfalseを返す
		// $path = array('controller' => 'users', 'action' => 'index');
		// user accountの場合、ここはfalseが入っているはず
		// $this->Session->check('xx') セッション値がセットされているかチェックなので、trueが返るが
		// $this->Session->read('xx') セッション読み込み　ではfalseが格納されていればfalseを返す
		$allkey = 'Auth.Permissions.controllers';
		if ($this->Session->check($allkey) && $this->Session->read($allkey)) {
			return true;
		}
		$key = 'Auth.Permissions.' . Inflector::camelize($path['controller']) . '.' . $path['action'];
		// $key => 'Auth.Permissions.Groups.index'　sessionに格納されてるかチェックしている
		if ($this->Session->check($key) && $this->Session->read($key) === true) {
			return true;
		}
		return false;
	}
}