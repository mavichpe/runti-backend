<?php
App::uses('AppController', 'Controller');
/**
 * Importers Controller
 *
 * @property Importer $Importer
 * @property PaginatorComponent $Paginator
 */
class ImportersController extends AppController {

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
		$this->Importer->recursive = 0;
		$this->set('importers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Importer->exists($id)) {
			throw new NotFoundException(__('Invalid importer'));
		}
		$options = array('conditions' => array('Importer.' . $this->Importer->primaryKey => $id));
		$this->set('importer', $this->Importer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Importer->create();
			if ($this->Importer->save($this->request->data)) {
				$this->Session->setFlash(__('The importer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The importer could not be saved. Please, try again.'));
			}
		}
		$users = $this->Importer->User->find('list');
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
		if (!$this->Importer->exists($id)) {
			throw new NotFoundException(__('Invalid importer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Importer->save($this->request->data)) {
				$this->Session->setFlash(__('The importer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The importer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Importer.' . $this->Importer->primaryKey => $id));
			$this->request->data = $this->Importer->find('first', $options);
		}
		$users = $this->Importer->User->find('list');
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
		$this->Importer->id = $id;
		if (!$this->Importer->exists()) {
			throw new NotFoundException(__('Invalid importer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Importer->delete()) {
			$this->Session->setFlash(__('The importer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The importer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
