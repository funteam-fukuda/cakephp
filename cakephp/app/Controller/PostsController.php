<?php

class PostsController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Flash');

    // Search
    public $components = array('Search.Prg');
    // URLフォーマットやSQLに渡す検索条件を構成する処理？
    public $presetVars = true;

    public $uses = array('Post', 'PostalCode', 'Attachment');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'search', 'zipcode', 'archives');
    }

    public function index() {
        $this->paginate = $this->Post->post_pagenate();
        $this->set('posts', $this->paginate());
    }

    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}

    	$post = $this->Post->findById($id);
    	if (!$post) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}
    	$this->set(compact('post'));
    }

    public function add() {

    	if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
    		if ($this->Post->saveAll($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
    			return $this->redirect(array('action' => 'index'));
    		}
            
            // tagが2つ以上選択されていない場合のエラーメッセージを取得
            $errors = $this->Post->validationErrors;
            if (!empty($errors['Tag'])) $this->set('tag_error', $errors['Tag']);
            // Attachment error
            if (!empty($errors['Attachment'])) $this->set('img_error', $errors['Attachment']);

            $this->Session->setFlash(__('Unable to add your post.'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
    	}
    }

    public function edit($id = null) {

    	if (!$id) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}

    	$post = $this->Post->findById($id);
    	if (!$post) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}
        // adminと投稿者のみedit許可
        if ($this->Auth->user('Group')['name'] != 'administrators') {
            if ($this->Auth->user('id') != $this->Post->findById($id)['Post']['user_id']) {
                return $this->redirect(array('action' => 'index'));
            }
        }
        // upload
        $this->set('uploads', $this->Post->findById($id));

    	if ($this->request->is(array('post', 'put'))) {
    		$this->Post->id = $id;
    		if ($this->Post->saveAll($this->request->data)) {
                $this->Session->setFlash(__('your post has been updated.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-success'
                ));
    			return $this->redirect(array('action' => 'index'));
    		} else {
                // tagが2つ以上選択されていない場合のエラーメッセージを取得
                $errors = $this->Post->validationErrors;
                if (!empty($errors['Tag'])) $this->set('tag_error', $errors['Tag']);
                // Attachment error
                if (!empty($errors['Attachment'])) $this->set('img_error', $errors['Attachment']);

                $this->Session->setFlash(__('Unable to update your post.'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-danger'
                ));
            }
    	}
    	// もしrequest->dataが空だったら、ここでデータを挿入している
    	if (!$this->request->data) {
    		$this->request->data = $post;
    	}
    }

    public function delete($id) {
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}
        // adminと投稿者のみedit許可
        if ($this->Auth->user('Group')['name'] != 'administrators') {
            if ($this->Auth->user('id') != $this->Post->findById($id)['Post']['user_id']) {
                return $this->redirect(array('action' => 'index'));
            }
        }
    	if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
    	} else {
            $this->Session->setFlash(__('The post with id: %s could not be deleted.', h($id)), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
	    }

	    return $this->redirect(array('action' => 'index'));
    }

    public function delete_image($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Attachment->delete($id)) {
            $this->Session->setFlash(__('delte image!'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-success'
            ));
        } else {
            $this->Session->setFlash(__('error!' . __line__), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-danger'
            ));
        }
        return $this->redirect($this->referer());
    }

    public function search() {
        // 深度
        #$this->Post->recursive = 2;
        // 検索条件データのハンドリング
        // 検索条件の解析結果をparsedParamsに設定
        $this->Prg->commonProcess();

        // parsedParamsをparseCriteria()に渡すことで、ModelのfilterArgsの定義に従ってwhere条件が構成され、検索が行われる
        $conditions = $this->Post->parseCriteria($this->Prg->parsedParams());
        if (!empty($conditions)) {
            $this->set('posts', $this->paginate(array(
                $conditions
                ))
            );
        }
    }

    public function zipcode() {
        $this->autoRender = false;
        if (!$this->request->is('ajax')) {
            throw new BadRequestException();            
        }

        $result = $this->PostalCode->find('all', array(
            'conditions' => array(
                'zipcode' => $this->request->data['PostalCode']
                )
            )   
        );
        return json_encode($result);
    }

    public function recent_comments() {
        $this->autoRender = false;
        if (!$this->request->is('ajax')) {
            throw new BadRequestException();
        }

        $result = $this->Comment->find('all', array(
            'order' => array('Comment.created' => 'desc'),
            'limit' => 4
            )
        );
        return json_encode($result);
    }

    public function get_recent_comments() {
        //$this->autoRender = false;
        $this->set('data', $this->request);
        if ($this->request->is(array('ajax', 'post'))) {
        }
    }

    public function archives($y, $m) {
        $conditions = array('DATE_FORMAT(Post.created, "%Y/%m")' => "{$y}/{$m}");
        $archives = $this->Post->find('all', array(
            'conditions' => $conditions
            )
        );
        $this->paginate = $this->Post->post_pagenate();
        $this->set('archives', $this->paginate($conditions));
    }
}