<?php
App::uses('AppController', 'Controller');
/**
 * Userpendens Controller
 *
 * @property Userpenden $Userpenden
 * @property PaginatorComponent $Paginator
 */
class UserpendensController extends AppController {

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
		$this->Userpenden->recursive = 0;
		$this->set('userpendens', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userpenden->exists($id)) {
			throw new NotFoundException(__('Invalid userpenden'));
		}
		$options = array('conditions' => array('Userpenden.' . $this->Userpenden->primaryKey => $id));
		$this->set('userpenden', $this->Userpenden->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userpenden->create();
			if ($this->Userpenden->save($this->request->data)) {
				$this->Session->setFlash(__('The userpenden has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userpenden could not be saved. Please, try again.'));
			}
		}
		$users = $this->Userpenden->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userpenden->exists($id)) {
			throw new NotFoundException(__('Invalid userpenden'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userpenden->save($this->request->data)) {
				$this->Session->setFlash(__('The userpenden has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The userpenden could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Userpenden.' . $this->Userpenden->primaryKey => $id));
			$this->request->data = $this->Userpenden->find('first', $options);
		}
		$users = $this->Userpenden->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userpenden->id = $id;
		if (!$this->Userpenden->exists()) {
			throw new NotFoundException(__('Invalid userpenden'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userpenden->delete()) {
			$this->Session->setFlash(__('The userpenden has been deleted.'));
		} else {
			$this->Session->setFlash(__('The userpenden could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
