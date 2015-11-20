<?php

App::uses('AppController', 'Controller');

/**
 * Albums Controller
 *
 * @property Album $Album
 * @property PaginatorComponent $Paginator
 */
class AlbumsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Album->recursive = 0;
        $this->set('albums', $this->Paginator->paginate());
    }

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function getAlbums() {
        $this->autoRender = false;
        $this->Album->recursive = -1;
        $userid = $this->request->data['userid'];
        $data = $this->Album->find('all', array(
            'fields' => 'Album.*,Userpenden.id ',
            'conditions' => "Album.publish = true",
            'order' => "Album.created desc",
            'joins' => array(
                array(
                    'table' => 'userpendens',
                    'alias' => 'Userpenden',
                    'type' => 'LEFT',
                    'foreignKey' => 'id',
                    'conditions' => array(
                        "Album.id = Userpenden.reference and Userpenden.kind ='album' and Userpenden.user_id = $userid",
                    )
                )
            )
        ));
        $this->response->body(json_encode($data));
    }

    public function getAlbum($albumId) {
        $this->checkAlbum($albumId);
        $this->autoRender = false;
        $this->Album->recursive = 2;
        $this->response->body(json_encode($this->Album->find('first', array('conditions' => 'Album.id =' . $albumId))));
    }

    private function checkAlbum($albumId) {
        $userId = $this->request->data['user_id'];
        $this->loadModel('Userpenden');
        if ($this->Userpenden->find('count', array('conditions' => array("Userpenden.user_id = $userId and Userpenden.reference = $albumId and Userpenden.kind = 'album'"))) == 0) {
            $data = array('Userpenden' => array('reference' => $albumId, 'user_id' => $userId, 'kind' => 'album'));
            $this->Userpenden->save($data);
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Album->exists($id)) {
            throw new NotFoundException(__('Invalid album'));
        }
        $options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
        $this->set('album', $this->Album->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Album->create();
            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash(__('The album has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The album could not be saved. Please, try again.'));
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
        if (!$this->Album->exists($id)) {
            throw new NotFoundException(__('Invalid album'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash(__('The album has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The album could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Album.' . $this->Album->primaryKey => $id));
            $this->request->data = $this->Album->find('first', $options);
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
        $this->Album->id = $id;
        if (!$this->Album->exists()) {
            throw new NotFoundException(__('Invalid album'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Album->delete()) {
            $this->Session->setFlash(__('The album has been deleted.'));
        } else {
            $this->Session->setFlash(__('The album could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
