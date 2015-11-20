<?php

App::uses('AppController', 'Controller');

/**
 * EventsPlaces Controller
 *
 * @property EventsPlace $EventsPlace
 * @property PaginatorComponent $Paginator
 */
class EventsPlacesController extends AppController {

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
        $this->EventsPlace->recursive = 0;
        $this->set('eventsPlaces', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->EventsPlace->exists($id)) {
            throw new NotFoundException(__('Invalid events place'));
        }
        $options = array('conditions' => array('EventsPlace.' . $this->EventsPlace->primaryKey => $id));
        $this->set('eventsPlace', $this->EventsPlace->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->EventsPlace->create();
            if ($this->EventsPlace->save($this->request->data)) {
                $this->Session->setFlash(__('The events place has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The events place could not be saved. Please, try again.'));
            }
        }
        $places = $this->EventsPlace->Place->find('list');
        $events = $this->EventsPlace->Event->find('list');
        $this->set(compact('places', 'events'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->EventsPlace->exists($id)) {
            throw new NotFoundException(__('Invalid events place'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->EventsPlace->save($this->request->data)) {
                $this->Session->setFlash(__('The events place has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The events place could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('EventsPlace.' . $this->EventsPlace->primaryKey => $id));
            $this->request->data = $this->EventsPlace->find('first', $options);
        }
        $places = $this->EventsPlace->Place->find('list');
        $events = $this->EventsPlace->Event->find('list');
        $this->set(compact('places', 'events'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->EventsPlace->id = $id;
        if (!$this->EventsPlace->exists()) {
            throw new NotFoundException(__('Invalid events place'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->EventsPlace->delete()) {
            $this->Session->setFlash(__('The events place has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The events place could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAndRedirect($id = null, $redirect = null) {
        $this->EventsPlace->id = $id;
        if (!$this->EventsPlace->exists()) {
            throw new NotFoundException(__('Invalid events place'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->EventsPlace->delete()) {
            $this->Session->setFlash(__('The events place has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The events place could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
