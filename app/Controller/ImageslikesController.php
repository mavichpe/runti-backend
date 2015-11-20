<?php
App::uses('AppController', 'Controller');
/**
 * Imageslikes Controller
 *
 * @property Imageslike $Imageslike
 * @property PaginatorComponent $Paginator
 */
class ImageslikesController extends AppController {

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
		$this->Imageslike->recursive = 0;
		$this->set('imageslikes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Imageslike->exists($id)) {
			throw new NotFoundException(__('Invalid imageslike'));
		}
		$options = array('conditions' => array('Imageslike.' . $this->Imageslike->primaryKey => $id));
		$this->set('imageslike', $this->Imageslike->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Imageslike->create();
			if ($this->Imageslike->save($this->request->data)) {
				$this->Session->setFlash(__('The imageslike has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imageslike could not be saved. Please, try again.'));
			}
		}
		$users = $this->Imageslike->User->find('list');
		$images = $this->Imageslike->Image->find('list');
		$this->set(compact('users', 'images'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Imageslike->exists($id)) {
			throw new NotFoundException(__('Invalid imageslike'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Imageslike->save($this->request->data)) {
				$this->Session->setFlash(__('The imageslike has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The imageslike could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Imageslike.' . $this->Imageslike->primaryKey => $id));
			$this->request->data = $this->Imageslike->find('first', $options);
		}
		$users = $this->Imageslike->User->find('list');
		$images = $this->Imageslike->Image->find('list');
		$this->set(compact('users', 'images'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Imageslike->id = $id;
		if (!$this->Imageslike->exists()) {
			throw new NotFoundException(__('Invalid imageslike'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Imageslike->delete()) {
			$this->Session->setFlash(__('The imageslike has been deleted.'));
		} else {
			$this->Session->setFlash(__('The imageslike could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
