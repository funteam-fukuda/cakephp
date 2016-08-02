<?php

class PostsController extends AppController {
    
    public $helpers = array('Html', 'Form', 'Flash');

    // Search
    public $components = array('Search.Prg');
    // URLフォーマットやSQLに渡す検索条件を構成する処理？
    public $presetVars = true;

    public $uses = array('Post', 'Category', 'PostalCode', 'Attachment');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

    public function index() {
        //debug($this->Auth->user('id'));
        $this->paginate = $this->Post->post_pagenate();
        $this->set('posts', $this->paginate());
        // layout off
        // $this->autoLayout = false;
        $login = $this->Auth->user();
        $this->set('login', $login);
    }

    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}

    	$post = $this->Post->findById($id);
    	if (!$post) {
    		throw new NotFoundException(__('Invalid post' . __line__ . 'line..'));
    	}
    	$this->set('post', $post);
    }

    public function add() {
        
        // add to categories table
        $this->loadModel('Category');
        $this->set('posts', $this->Category->find('list', array('fields' => 'Category.name')));

        // tag
        $this->set('tag', $this->Post->find('all'));

    	if ($this->request->is('post')) {
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
    		#$this->Post->create();
    		if ($this->Post->saveAll($this->request->data)) {
    			$this->Flash->success(__('Your post has been saved.'));
    			return $this->redirect(array('action' => 'index'));
    		}
    		$this->Flash->error(__('Unable to add your post.'));
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

        // upload
        $this->set('uploads', $this->Post->findById($id));

        // add to categories table
        $this->loadModel('Category');
        $this->set('posts', $this->Category->find('list', array('fields' => 'Category.name')));

        // tag
        $this->set('tag', $this->Post->find('all'));

    	if ($this->request->is(array('post', 'put'))) {
    		$this->Post->id = $id;
    		if ($this->Post->saveAll($this->request->data)) {
    			$this->Flash->success(__('your post has been updated.'));
    			return $this->redirect(array('action' => 'index'));
    		}
    		$this->Flash->error(__('Unable to update your post.'));
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
    	
    	if ($this->Post->delete($id)) {
    		$this->Flash->success(__('The post with id: %s has been deleted.', h($id)));
    	} else {
	    	$this->Flash->error(__('The post with id: %s could not be deleted.', h($id)));
	    }

	    return $this->redirect(array('action' => 'index'));
    }

    public function delete_image($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Attachment->delete($id)) {
            $this->Flash->success(__('delete image!'));
        } else {
            $this->Flash->error(__('error'));
        }

        return $this->redirect($this->referer());
    }

    public function isAuthorized($user) {
        
        // index.ctpからaddに遷移した際
        if ($this->action == 'add') {
            return true;
        }
        // edit or delete の場合
        if (in_array($this->action, array('edit', 'delete'))) {
            // request page ID を取得
            $postId = (int) $this->request->params['pass'][0];
            // ログイン中のuser IDと比較して一致する場合、その他のアクションも許可
            if ($this->Post->isOwnedBy($postId, $user[('id')])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function search() {

        // 深度
        #$this->Post->recursive = 2;
        // 検索条件データのハンドリング
        // 検索条件の解析結果をparsedParamsに設定
        $this->Prg->commonProcess();

        // parsedParamsをparseCriteria()に渡すことで、ModelのfilterArgsの定義に従ってwhere条件が構成され、検索が行われる
        $conditions = $this->Post->parseCriteria($this->Prg->parsedParams());
        $this->set('posts', $this->paginate(array(
            $conditions
            ))
        );
        #$this->set('tags', $this->Post->Tag->find('list'));
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
}