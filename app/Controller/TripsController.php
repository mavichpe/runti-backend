<?php

App::uses('AppController', 'Controller');

/**
 * Trips Controller
 *
 * @property Trip $Trip
 * @property PaginatorComponent $Paginator
 */
class TripsController extends AppController {

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
        $this->Trip->recursive = 0;
        $this->set('trips', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Trip->exists($id)) {
            throw new NotFoundException(__('Invalid trip'));
        }
        $options = array('conditions' => array('Trip.' . $this->Trip->primaryKey => $id));
        $this->set('trip', $this->Trip->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Trip->create();
            if ($this->Trip->save($this->request->data)) {
                $this->Session->setFlash(__('The trip has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The trip could not be saved. Please, try again.'));
            }
        }
        $events = $this->Trip->Event->find('list');
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
        if (!$this->Trip->exists($id)) {
            throw new NotFoundException(__('Invalid trip'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Trip->save($this->request->data)) {
                $this->Session->setFlash(__('The trip has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The trip could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Trip.' . $this->Trip->primaryKey => $id));
            $this->request->data = $this->Trip->find('first', $options);
        }
        $events = $this->Trip->Event->find('list');
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
        $this->Trip->id = $id;
        if (!$this->Trip->exists()) {
            throw new NotFoundException(__('Invalid trip'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Trip->delete()) {
            $this->Session->setFlash(__('The trip has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The trip could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAndRedirect($id = null, $redirect = null) {
        $this->Trip->id = $id;
        if (!$this->Trip->exists()) {
            throw new NotFoundException(__('Invalid trip'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Trip->delete()) {
            $this->Session->setFlash(__('The trip has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The trip could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
