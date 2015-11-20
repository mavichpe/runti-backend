<?php

App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate());
    }

    public function getPost($id) {
        $this->autoRender = false;
        $this->Post->recursive = 0;
        $this->response->body(json_encode($this->Post->find('first', array('conditions' => "Post.id = $id"))));
    }

    public function getPosts($tipo) {
        $this->autoRender = false;
        $this->Post->recursive = -1;
        $this->response->body(json_encode($this->Post->find('all', array('conditions' => "Post.categoria = $tipo", 'order' => 'Post.id DESC'))));
    }

    public function getTodosLosArticulos() {
        $this->autoRender = false;
        $this->Post->recursive = -1;

        $posts = $this->Post->find('all', array('limit' => 50, 'order' => 'Post.id DESC'));
        $response = array();
        foreach ($posts as $post) {
            $response['byKind'][$post['Post']['categoria']][] = $post;
            $response['byId'][$post['Post']['id']] = $post;
        }

        $this->response->body(json_encode($response));
    }

    public function getLikeStatusPost($imageId, $userId) {
        $this->autoRender = false;
        $this->loadModel('Postslike');
        $this->Postslike->recursive = -1;
        $like = $this->Postslike->find('count', array('conditions' => 'Postslike.post_id =' . $imageId . ' and Postslike.user_id =' . $userId));
        $response['liked'] = $like >= 1 ? 1 : 0;
        $this->response->body(json_encode($response));
    }

    public function setLikePost() {
        $this->autoRender = false;
        $this->loadModel('Postslike');
        $datos = $this->request->data;
        if ($datos['Postslike']['like']) {
            if ($this->Postslike->save($datos)) {
                $response['store'] = true;
                $response['liked'] = true;
            } else {
                $response['store'] = false;
            }
        } else {
            if ($this->Postslike->deleteAll('Postslike.post_id =' . $datos['Postslike']['post_id'] . ' and Postslike.user_id =' . $datos['Postslike']['user_id'])) {
                $response['store'] = true;
                $response['liked'] = false;
            } else {
                $response['store'] = false;
            }
        }

        $this->response->body(json_encode($response));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->layout = 'view';
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $post = $this->Post->find('first', $options);
        $this->set('title', $post['Post']['title']);
        $this->set('post', $post);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $sponsors = array('0' => 'Ninguno') + $this->Post->Sponsor->find('list');
        $this->set('sponsors', $sponsors);

        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $sponsors = array('0' => 'Ninguno') + $this->Post->Sponsor->find('list');
        $this->set('sponsors', $sponsors);

        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            $filePath = 'posts' . DS . $id . DS;
            $destenyPath = WWW_ROOT . 'img' . DS;
            $image = null;

            $imageInfo = $data['Post']['img'];
            $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
            if (strlen($extencion) == 0)
                unset($data['Post']['img']);
            else if (!is_array($data['Post']['img'])) {
                $data['Post']['img'] = '';
            } else {
                $data['Post']['img']['nombre'] = 'post' . $id;
                $image = $data['Post']['img'];
                $data['Post']['img'] = $filePath . 'post' . $id . '.' . $extencion;
            }
            if ($this->Post->save($data)) {
                $this->Session->setFlash(__('The post has been saved.'));
                if ($image != null) {
                    $this->updateImage($image, $destenyPath . $filePath, $image['nombre']);
                }
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Post->delete()) {
            $this->Session->setFlash(__('The post has been deleted.'));
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
