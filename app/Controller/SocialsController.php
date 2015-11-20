<?php

App::uses('AppController', 'Controller');

/**
 * Socials Controller
 *
 * @property Social $Social
 * @property PaginatorComponent $Paginator
 */
class SocialsController extends AppController {

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
        $this->Social->recursive = 0;
        $this->set('socials', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Social->exists($id)) {
            throw new NotFoundException(__('Invalid social'));
        }
        $options = array('conditions' => array('Social.' . $this->Social->primaryKey => $id));
        $this->set('social', $this->Social->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Social->create();
            if ($this->Social->save($this->request->data)) {
                $this->Session->setFlash(__('The social has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The social could not be saved. Please, try again.'));
            }
        }
        $events = $this->Social->Event->find('list');
        $this->set(compact('events'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Social->exists($id)) {
            throw new NotFoundException(__('Invalid social'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Social->save($this->request->data)) {
                $this->Session->setFlash(__('The social has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The social could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Social.' . $this->Social->primaryKey => $id));
            $this->request->data = $this->Social->find('first', $options);
        }
        $events = $this->Social->Event->find('list');
        $this->set(compact('events'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Social->id = $id;
        if (!$this->Social->exists()) {
            throw new NotFoundException(__('Invalid social'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Social->delete()) {
            $this->Session->setFlash(__('The social has been deleted.'));
        } else {
            $this->Session->setFlash(__('The social could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteAndRedirect($id = null, $redirect = null) {
        $this->Social->id = $id;
        if (!$this->Social->exists()) {
            throw new NotFoundException(__('Invalid Social'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Social->delete()) {
            $this->Session->setFlash(__('The Social has been deleted.'));
            if (isset($redirect)) {
                $this->redirect(Router::url(base64_decode($redirect), true));
            }
        } else {
            $this->Session->setFlash(__('The Social could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
