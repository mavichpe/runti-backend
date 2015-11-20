<?php

App::uses('AppController', 'Controller');

/**
 * EventsKitelements Controller
 *
 * @property EventsKitelement $EventsKitelement
 * @property PaginatorComponent $Paginator
 */
class EventsKitelementsController extends AppController {

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
        $this->EventsKitelement->recursive = 0;
        $this->set('eventsKitelements', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->EventsKitelement->exists($id)) {
            throw new NotFoundException(__('Invalid events kitelement'));
        }
        $options = array('conditions' => array('EventsKitelement.' . $this->EventsKitelement->primaryKey => $id));
        $this->set('eventsKitelement', $this->EventsKitelement->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->EventsKitelement->create();
            if ($this->EventsKitelement->save($this->request->data)) {
                $this->Session->setFlash(__('The events kitelement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The events kitelement could not be saved. Please, try again.'));
            }
        }
        $events = $this->EventsKitelement->Event->find('list');
        $kitelements = $this->EventsKitelement->Kitelement->find('list');
        $this->set(compact('events', 'kitelements'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->EventsKitelement->exists($id)) {
            throw new NotFoundException(__('Invalid events kitelement'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->EventsKitelement->save($this->request->data)) {
                $this->Session->setFlash(__('The events kitelement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The events kitelement could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('EventsKitelement.' . $this->EventsKitelement->primaryKey => $id));
            $this->request->data = $this->EventsKitelement->find('first', $options);
        }
        $events = $this->EventsKitelement->Event->find('list');
        $kitelements = $this->EventsKitelement->Kitelement->find('list');
        $this->set(compact('events', 'kitelements'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->EventsKitelement->id = $id;
        if (!$this->EventsKitelement->exists()) {
            throw new NotFoundException(__('Invalid events kitelement'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->EventsKitelement->delete()) {
            $this->Session->setFlash(__('The events kitelement has been deleted.'));
        } else {
            $this->Session->setFlash(__('The events kitelement could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAndRedirect($id = null, $redirect = null) {
        $this->EventsKitelement->id = $id;
        if (!$this->EventsKitelement->exists()) {
            throw new NotFoundException(__('Invalid events kitelement'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->EventsKitelement->delete()) {
            $this->Session->setFlash(__('The events kitelement has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The events kitelement could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
