<?php
App::uses('AppController', 'Controller');
/**
 * Imagescomments Controller
 *
 * @property Imagescomment $Imagescomment
 * @property PaginatorComponent $Paginator
 */
class ImagescommentsController extends AppController {

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
		$this->Imagescomment->recursive = 0;
		$this->set('imagescomments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Imagescomment->exists($id)) {
			throw new NotFoundException(__('Invalid imagescomment'));
		}
		$options = array('conditions' => array('Imagescomment.' . $this->Imagescomment->primaryKey => $id));
		$this->set('imagescomment', $this->Imagescomment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Imagescomment->create();
			if ($this->Imagescomment->save($this->request->data)) {
				$this->Session->setFlash(__('The imagescomment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imagescomment could not be saved. Please, try again.'));
			}
		}
		$images = $this->Imagescomment->Image->find('list');
		$users = $this->Imagescomment->User->find('list');
		$this->set(compact('images', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Imagescomment->exists($id)) {
			throw new NotFoundException(__('Invalid imagescomment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Imagescomment->save($this->request->data)) {
				$this->Session->setFlash(__('The imagescomment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imagescomment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Imagescomment.' . $this->Imagescomment->primaryKey => $id));
			$this->request->data = $this->Imagescomment->find('first', $options);
		}
		$images = $this->Imagescomment->Image->find('list');
		$users = $this->Imagescomment->User->find('list');
		$this->set(compact('images', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Imagescomment->id = $id;
		if (!$this->Imagescomment->exists()) {
			throw new NotFoundException(__('Invalid imagescomment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Imagescomment->delete()) {
			$this->Session->setFlash(__('The imagescomment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The imagescomment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
