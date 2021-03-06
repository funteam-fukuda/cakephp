<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator')
	);

	public $layout = 'bootstrap';

	public $components = 
		array(
		/*'DebugKit.Toolbar',*/
		'Flash',
		'Acl',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			),
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			)
		),
		'Session',
		'Common'
	);

	public $uses = array('Post', 'Category', 'Tag', 'Comment');

	public function beforeFilter() {
		
		$this->Auth->allow('display');

		// ログインページのパス
		$this->Auth->loginAction = array(
			'controller' => 'users',
			'action' => 'login'
		);
		// ログアウト後のリダイレクト先
		$this->Auth->logoutRedirect = array(
			'controller' => 'users',
			'action' => 'login'
		);
		// ログイン後のリダイレクト先
		$this->Auth->loginRedirect = array(
			'controller' => 'posts',
			'action' => 'index'
		);
        // search tags
        $this->set('head_tags', $this->Tag->find('list'));
        // search categories
        $this->set('head_categories', $this->Category->find('list'));
        // recent comments
        $this->set('recent_comments', $this->Comment->find('all', array(
        	'order' => array('Comment.created' => 'desc'),
        	'limit' => 4
        	)
        ));

		$login = $this->Auth->user();
        $this->set('login', $login);

        if ($this->Session->read('errors')) {
        	foreach ($this->Session->read('errors') as $model => $errors) {
        		$this->loadModel($model);
        		$this->$model->validationErrors = $errors;
        	}
        	$this->Session->delete('errors');
        }

        // archive
        $this->set('archive', $this->Post->get_archive());
	}
}