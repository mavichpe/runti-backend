<?php

App::uses('AppController', 'Controller');

/**
 * Kitdelivers Controller
 *
 * @property Kitdeliver $Kitdeliver
 * @property PaginatorComponent $Paginator
 */
class KitdeliversController extends AppController {

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
        $this->Kitdeliver->recursive = 0;
        $this->set('kitdelivers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Kitdeliver->exists($id)) {
            throw new NotFoundException(__('Invalid kitdeliver'));
        }
        $options = array('conditions' => array('Kitdeliver.' . $this->Kitdeliver->primaryKey => $id));
        $this->set('kitdeliver', $this->Kitdeliver->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Kitdeliver->create();
            if ($this->Kitdeliver->save($this->request->data)) {
                $this->Session->setFlash(__('The kitdeliver has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The kitdeliver could not be saved. Please, try again.'));
            }
        }
        $events = $this->Kitdeliver->Event->find('list');
        $places = $this->Kitdeliver->Place->find('list');
        $this->set(compact('events', 'places'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Kitdeliver->exists($id)) {
            throw new NotFoundException(__('Invalid kitdeliver'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Kitdeliver->save($this->request->data)) {
                $this->Session->setFlash(__('The kitdeliver has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The kitdeliver could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Kitdeliver.' . $this->Kitdeliver->primaryKey => $id));
            $this->request->data = $this->Kitdeliver->find('first', $options);
        }
        $events = $this->Kitdeliver->Event->find('list');
        $places = $this->Kitdeliver->Place->find('list');
        $this->set(compact('events', 'places'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Kitdeliver->id = $id;
        if (!$this->Kitdeliver->exists()) {
            throw new NotFoundException(__('Invalid kitdeliver'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Kitdeliver->delete()) {
            $this->Session->setFlash(__('The kitdeliver has been deleted.'));
        } else {
            $this->Session->setFlash(__('The kitdeliver could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAndRedirect($id = null, $redirect = null) {
        $this->Kitdeliver->id = $id;
        if (!$this->Kitdeliver->exists()) {
            throw new NotFoundException(__('Invalid Kitdeliver'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Kitdeliver->delete()) {
            $this->Session->setFlash(__('The Kitdeliver has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The Kitdeliver could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
