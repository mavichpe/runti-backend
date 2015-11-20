<?php
App::uses('AppController', 'Controller');
/**
 * Postslikes Controller
 *
 * @property Postslike $Postslike
 * @property PaginatorComponent $Paginator
 */
class PostslikesController extends AppController {

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
		$this->Postslike->recursive = 0;
		$this->set('postslikes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Postslike->exists($id)) {
			throw new NotFoundException(__('Invalid postslike'));
		}
		$options = array('conditions' => array('Postslike.' . $this->Postslike->primaryKey => $id));
		$this->set('postslike', $this->Postslike->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Postslike->create();
			if ($this->Postslike->save($this->request->data)) {
				$this->Session->setFlash(__('The postslike has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The postslike could not be saved. Please, try again.'));
			}
		}
		$users = $this->Postslike->User->find('list');
		$posts = $this->Postslike->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Postslike->exists($id)) {
			throw new NotFoundException(__('Invalid postslike'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Postslike->save($this->request->data)) {
				$this->Session->setFlash(__('The postslike has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The postslike could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Postslike.' . $this->Postslike->primaryKey => $id));
			$this->request->data = $this->Postslike->find('first', $options);
		}
		$users = $this->Postslike->User->find('list');
		$posts = $this->Postslike->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Postslike->id = $id;
		if (!$this->Postslike->exists()) {
			throw new NotFoundException(__('Invalid postslike'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Postslike->delete()) {
			$this->Session->setFlash(__('The postslike has been deleted.'));
		} else {
			$this->Session->setFlash(__('The postslike could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
