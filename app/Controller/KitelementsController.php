<?php

App::uses('AppController', 'Controller');

/**
 * Kitelements Controller
 *
 * @property Kitelement $Kitelement
 * @property PaginatorComponent $Paginator
 */
class KitelementsController extends AppController {

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
        $this->Kitelement->recursive = 0;
        $this->set('kitelements', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Kitelement->exists($id)) {
            throw new NotFoundException(__('Invalid kitelement'));
        }
        $options = array('conditions' => array('Kitelement.' . $this->Kitelement->primaryKey => $id));
        $this->set('kitelement', $this->Kitelement->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Kitelement->create();
            if ($this->Kitelement->save($this->request->data)) {
                if (!$this->request->is('ajax')) {
                    $this->Session->setFlash(__('The kitelement has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $response = array('store' => true, 'id' => $this->Kitelement->id);
                    $this->autoRender = false;
                    $this->response->body(json_encode($response));
                }
            } else {
                if (!$this->request->is('ajax')) {
                    $this->Session->setFlash(__('The kitelement could not be saved. Please, try again.'));
                } else {
                    $response = array('store' => false);
                    $this->autoRender = false;
                    $this->response->body(json_encode($response));
                }
            }
        }
        $events = $this->Kitelement->Event->find('list');
        $this->set(compact('events'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Kitelement->exists($id)) {
            throw new NotFoundException(__('Invalid kitelement'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Kitelement->save($this->request->data)) {
                $this->Session->setFlash(__('The kitelement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The kitelement could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Kitelement.' . $this->Kitelement->primaryKey => $id));
            $this->request->data = $this->Kitelement->find('first', $options);
        }
        $events = $this->Kitelement->Event->find('list');
        $this->set(compact('events'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Kitelement->id = $id;
        if (!$this->Kitelement->exists()) {
            throw new NotFoundException(__('Invalid kitelement'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Kitelement->delete()) {
            $this->Session->setFlash(__('The kitelement has been deleted.'));
        } else {
            $this->Session->setFlash(__('The kitelement could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
