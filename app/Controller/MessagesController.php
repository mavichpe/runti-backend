<?php

App::uses('AppController', 'Controller');
App::import('Model', 'RegistrationDevice');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

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
        $this->Message->recursive = 0;
        $this->set('notifications', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid notification'));
        }
        $options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
        $this->set('notification', $this->Message->find('first', $options));
    }

    public function getConversation($userId, $friedId) {
        $this->autoRender = false;
        $data = $this->Message->find('all', array('conditions' =>
            array(
                'or' => array(
                    array(
                        'Message.user_id =' . $userId,
                        'Message.friend_id =' . $friedId),
                    array(
                        'Message.user_id =' . $friedId,
                        'Message.friend_id =' . $userId,
                    )
                )
            ),
            'order' => 'Message.created asc',
            'limit' => 100
        ));
        $this->response->body(json_encode($data));
    }

    /**
     * add method
     *
     * @return void
     */
    public function send() {
        $this->autoRender = false;
        $response = array('send' => false);
        if ($this->request->is('post')) {
            $this->Message->create();
            $data = $this->request->data;
            if ($this->Message->save($data)) {
                $regDevModel = new RegistrationDevice();

                $android_ids = $regDevModel->find('list', array(
                    'fields' => array('registration_id'),
                    'conditions' => array(
                        'User.id' => $data['Message']['friend_id'],
                        'RegistrationDevice.platform' => 0
                    ),
                    'recursive' => 2
                ));
                $ios_ids = $regDevModel->find('list', array(
                    'fields' => array('registration_id'),
                    'conditions' => array(
                        'User.id' => $data['Message']['friend_id'],
                        'RegistrationDevice.platform' => 1
                    ),
                    'recursive' => 2
                ));

                $route = '#/chat/' . $data['Message']['user_id'] . '/' . $data['Message']['message'];
                $android_ids = array_values($android_ids);
                $ios_ids = array_values($ios_ids);

                $this->send_android_notification('Mensaje Nuevo', $this->request->data['Message']['message'], $route, $android_ids, $data['Message']['user_id']);
                $this->send_ios_notification('Mensaje nuevo', $this->request->data['Message']['message'], $route, $ios_ids, $data['Message']['user_id']);
                $response['send'] = true;
            } else {
                $response['send'] = false;
            }
        }
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
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid notification'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('The notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
            $this->request->data = $this->Message->find('first', $options);
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
        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException(__('Invalid notification'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Message->delete()) {
            $this->Session->setFlash(__('The notification has been deleted.'));
        } else {
            $this->Session->setFlash(__('The notification could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
