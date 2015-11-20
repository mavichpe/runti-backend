<?php

App::uses('AppController', 'Controller');

/**
 * Alerts Controller
 *
 * @property Alert $Alert
 * @property PaginatorComponent $Paginator
 */
class AlertsController extends AppController {

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
        $this->Alert->recursive = 0;
        $this->set('alerts', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Alert->exists($id)) {
            throw new NotFoundException(__('Invalid alert'));
        }
        $options = array('conditions' => array('Alert.' . $this->Alert->primaryKey => $id));
        $this->set('alert', $this->Alert->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Alert->create();
            if ($this->Alert->save($this->request->data)) {
                $this->Session->setFlash(__('The alert has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The alert could not be saved. Please, try again.'));
            }
        }
    }

    public function agregar() {
        $this->autoRender = false;
        $this->Alert->create();
        $response = array();
        if ($this->Alert->save($this->request->data)) {
            $response['store'] = true;
            $response['id'] = $this->Alert->id;
        } else {
            $response['store'] = false;
        }
        $this->response->body(json_encode($response));
    }

    public function getall($userid, $data) {
        $this->autoRender = false;
        $response = $this->Alert->find('all', array('conditions' => array('Alert.userid = ' . $userid . ' and Alert.date > ' . $data)));
        $this->response->body(json_encode($response));
    }

    public function cancel($alertId) {
        $this->autoRender = false;
        $response = $this->Alert->delete($alertId);
        $this->response->body(json_encode($response));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Alert->exists($id)) {
            throw new NotFoundException(__('Invalid alert'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Alert->save($this->request->data)) {
                $this->Session->setFlash(__('The alert has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The alert could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Alert.' . $this->Alert->primaryKey => $id));
            $this->request->data = $this->Alert->find('first', $options);
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
        $this->Alert->id = $id;
        if (!$this->Alert->exists()) {
            throw new NotFoundException(__('Invalid alert'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Alert->delete()) {
            $this->Session->setFlash(__('The alert has been deleted.'));
        } else {
            $this->Session->setFlash(__('The alert could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
