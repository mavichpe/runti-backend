<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
// $this->Auth->allow();
    }

    public function getData($id) {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $this->response->body(json_encode($this->User->find('first', array('conditions' => "User.id = $id"))));
    }

    public function getDataByFcid($id) {
        $this->autoRender = false;
        $this->User->recursive = -1;
        $this->response->body(json_encode($this->User->find('first', array('conditions' => "User.fcid = $id"))));
    }

    public function search() {
        $this->autoRender = false;
        $this->User->recursive = -1;
        $data = $this->request->data;
        $this->response->body(json_encode($this->User->find('all', array('conditions' => "User.nombre like '%" . $data['filter'] . "%' or  User.apellido like '%" . $data['filter'] . "%' or User.email like '%" . $data['filter'] . "%'"))));
    }

    public function searchFriends($userid) {
        $this->autoRender = false;
        $this->User->recursive = -1;
        $data = $this->request->data;
        $this->response->body(json_encode($this->User->find('all', array(
                            'fields' => array('DISTINCT User.*'),
                            'joins' => array(
                                array(
                                    'table' => 'friends',
                                    'alias' => 'Friend',
                                    'type' => 'INNER',
                                    'conditions' => array(
                                        'Friend.friend_id = User.id or Friend.user_id = User.id'
                                    )
                                )
                            ),
                            'conditions' => array(
                                'and' => array(
                                    'or' => array(
                                        "User.nombre like '%" . $data['filter'] . "%'",
                                        "User.apellido like '%" . $data['filter'] . "%'",
                                        "User.email like '%" . $data['filter'] . "%'"),
                                    'Friend.user_id = ' . $userid
                                )
                            )
                                )
                        )
                )
        );
    }

    public function getFriendStatus($userProfile, $currentUser) {
        $this->autoRender = false;
        $this->loadModel('Friend');
        $this->Friend->recursive = -1;
        $friendStatus = $this->Friend->find('first', array('conditions' => array(
                'or' => array(
                    'Friend.user_id =' . $userProfile . ' and Friend.friend_id =' . $currentUser,
                    'Friend.friend_id =' . $userProfile . ' and Friend.user_id =' . $currentUser,
                )
            )
        ));
        $friendStatus['Friend']['isSended'] = isset($friendStatus['Friend']) ? 1 : 0;
        $friendStatus['Friend']['isFriend'] = isset($friendStatus['Friend']['estado']) ? $friendStatus['Friend']['estado'] : 0;

        $this->response->body(json_encode($friendStatus));
    }

    public function setData() {
        $this->autoRender = false;
        $this->User->recursive = -1;
        $data = $this->request->data;
        if (isset($data['User']['nacimiento']) && is_array($data['User']['nacimiento'])) {
            $data['User']['nacimiento'] = $data['User']['nacimiento']['ano'] . '-' . $data['User']['nacimiento']['mes'] . '-' . $data['User']['nacimiento']['dia'];
        }
        $respuesta = array();
        $respuesta['datos'] = $data;

        if ($this->User->save($data)) {
            $respuesta['store'] = true;
        } else
            $respuesta['store'] = false;

        $this->response->body(json_encode($respuesta));
    }

    public function makeFriend() {
        $this->autoRender = false;
        $this->loadModel('Friend');
        $data = $this->request->data;
        $respuesta = array();
        $respuesta['datos'] = $data;

        if ($this->Friend->save($data)) {
            $respuesta['store'] = true;
        } else
            $respuesta['store'] = false;

        $this->response->body(json_encode($respuesta));
    }

    public function updateFriendRequest() {
        $this->autoRender = false;
        $this->loadModel('Friend');
        $data = $this->request->data;
        $respuesta = array();
        $respuesta['datos'] = $data;

        if ($this->Friend->save($data)) {
            $respuesta['store'] = true;
        } else
            $respuesta['store'] = false;

        $this->response->body(json_encode($respuesta));
    }

    public function getFriendRequest($userId) {
        $this->autoRender = false;
        $this->loadModel('Friend');
        $this->Friend->recursive = -1;
        $friendRequests = $this->Friend->find('all', array('order' => 'Friend.created DESC', 'conditions' => 'Friend.user_id =' . $userId . ' and Friend.estado = 0 '));
        foreach ($friendRequests as &$friendRequest) {
            $friendRequest['Friend']['friend'] = $this->User->read(null, $friendRequest['Friend']['friend_id']);
        }
        $this->response->body(json_encode($friendRequests));
    }

    public function getFriends($userId, $chatSegmetation = false) {
        $this->autoRender = false;
        $this->loadModel('Friend');
        $this->loadModel('Message');
        $this->Friend->recursive = -1;
        $this->User->recursive = -1;
        $this->Message->recursive = -1;

        $friendRequests = $this->Friend->find('all', array('order' => 'Friend.created DESC', 'conditions' => '(Friend.user_id =' . $userId . ' or Friend.friend_id =' . $userId . ') and Friend.estado = 1 '));
        $friendWithChat = array();
        $friends = array();
        foreach ($friendRequests as $key => &$friendRequest) {
            $friendRequest['Friend']['friend'] = $this->User->read(null, $friendRequest['Friend']['friend_id']);
            $friendRequest['Friend']['user'] = $this->User->read(null, $friendRequest['Friend']['user_id']);
            $friendRequest['Message']['lastmessage'] = $this->Message->find('first', array(
                'conditions' => array(
                    'or' => array(
                        'Message.user_id = ' . $friendRequest['Friend']['friend_id'] . ' and Message.friend_id = ' . $friendRequest['Friend']['user_id'],
                        'Message.user_id = ' . $friendRequest['Friend']['user_id'] . ' and Message.friend_id = ' . $friendRequest['Friend']['friend_id']
                    )
                ),
                'order' => 'Message.created DESC'
                    )
            );
            if ($chatSegmetation) {
                if (isset($friendRequest['Message']['lastmessage']["Message"]["id"]))
                    $friendWithChat[] = $friendRequest;
                else {
                    $friends[] = $friendRequest;
                }
            }
        }
        if ($chatSegmetation) {
            $friendRequests = array();
            $friendRequests['Friends'] = $friends;
            $friendRequests['Chats'] = $friendWithChat;
        }
        $this->response->body(json_encode($friendRequests));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->isCallFromApp()) {
                    $this->layout = 'ajax';
                    $this->set('response', array('login' => true, 'userId' => $this->Auth->user('id'), 'userTemplate' => $this->Auth->user('template')));
                    exec('ejabberdctl register ' + $this->Auth->user('nombre') + $this->Auth->user('id') + ' runti.com ' + $this->request->data['appKey']);
                } else
                    $this->redirect($this->Auth->redirect());
            } else {
                if ($this->isCallFromApp()) {
                    $this->layout = 'ajax';
                    $this->set('response', array('login' => false));
                } else
                    $this->Session->setFlash(__('Usuario o contraseña incorrecta'));
            }
        }
    }

    public function fblogin() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->layout = 'ajax';

            $user = $this->User->find('first', array('conditions' => 'User.fcid = ' . $data['User']['fcid']));
            $this->set('response', array('login' => false));
            if (!isset($user['User']['id'])) {
                $this->User->create();
                $user = $this->User->save($data);
            }
            $response = array('login' => true, 'userId' => $user['User']['id'], 'fcid' => $user['User']['fcid'], 'userTemplate' => $user['User']['template']);
            $response['execm'] = exec('sudo ejabberdctl register ' . $user['User']['nombre'] . $user['User']['id'] . ' runti.com ' . $this->request->data['appKey']);
            $this->set('response', $response);
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
