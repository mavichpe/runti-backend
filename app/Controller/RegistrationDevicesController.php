<?php

App::uses('AppController', 'Controller');

/**
 * RegistrationDevices Controller
 *
 * @property RegistrationDevice $RegistrationDevice
 * @property PaginatorComponent $Paginator
 */
class RegistrationDevicesController extends AppController {

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
        $this->RegistrationDevice->recursive = 0;
        $this->set('registrationDevices', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->RegistrationDevice->exists($id)) {
            throw new NotFoundException(__('Invalid registration device'));
        }
        $options = array('conditions' => array('RegistrationDevice.' . $this->RegistrationDevice->primaryKey => $id));
        $this->set('registrationDevice', $this->RegistrationDevice->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->autoRender = false;

        $this->RegistrationDevice->create();

        $response = 'false';
        if (isset($this->request->data['registration_id'])) {
            if ($this->RegistrationDevice->save($this->request->data)) {
                $response = 'true';
            }
        }

        $this->response->body(json_encode(array('response' => $response, 'data' => $this->request->data)));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->RegistrationDevice->exists($id)) {
            throw new NotFoundException(__('Invalid registration device'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->RegistrationDevice->save($this->request->data)) {
                $this->Session->setFlash(__('The registration device has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The registration device could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('RegistrationDevice.' . $this->RegistrationDevice->primaryKey => $id));
            $this->request->data = $this->RegistrationDevice->find('first', $options);
        }
        $users = $this->RegistrationDevice->User->find('list');
        $registrations = $this->RegistrationDevice->Registration->find('list');
        $this->set(compact('users', 'registrations'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->RegistrationDevice->id = $id;
        if (!$this->RegistrationDevice->exists()) {
            throw new NotFoundException(__('Invalid registration device'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->RegistrationDevice->delete()) {
            $this->Session->setFlash(__('The registration device has been deleted.'));
        } else {
            $this->Session->setFlash(__('The registration device could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
