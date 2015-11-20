<?php

App::uses('AppController', 'Controller');

/**
 * Sponsors Controller
 *
 * @property Sponsor $Sponsor
 * @property PaginatorComponent $Paginator
 */
class SponsorsController extends AppController {

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
        $this->Sponsor->recursive = 0;
        $this->set('sponsors', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Sponsor->exists($id)) {
            throw new NotFoundException(__('Invalid sponsor'));
        }
        $options = array('conditions' => array('Sponsor.' . $this->Sponsor->primaryKey => $id));
        $this->set('sponsor', $this->Sponsor->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Sponsor->create();
            if ($this->Sponsor->save($this->request->data)) {
                $this->Session->setFlash(__('The sponsor has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
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
        if (!$this->Sponsor->exists($id)) {
            throw new NotFoundException(__('Invalid sponsor'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            $filePath = 'sponsor' . DS . $id . DS;
            $destenyPath = WWW_ROOT . 'img' . DS;
            $image = null;

            $imageInfo = $data['Sponsor']['logo'];
            $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
            if (strlen($extencion) == 0)
                unset($data['Sponsor']['logo']);
            else if (!is_array($data['Sponsor']['logo'])) {
                $data['Sponsor']['logo'] = '';
            } else {
                $data['Sponsor']['logo']['nombre'] = 'sponsor' . $id;
                $image = $data['Sponsor']['logo'];
                $data['Sponsor']['logo'] = $filePath . 'sponsor' . $id . '.' . $extencion;
            }
            if ($this->Sponsor->save($data)) {
                $this->Session->setFlash(__('The sponsor has been saved.'));
                if ($image != null) {
                    $this->updateImage($image, $destenyPath . $filePath, $image['nombre']);
                }
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sponsor could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Sponsor.' . $this->Sponsor->primaryKey => $id));
            $this->request->data = $this->Sponsor->find('first', $options);
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
        $this->Sponsor->id = $id;
        if (!$this->Sponsor->exists()) {
            throw new NotFoundException(__('Invalid sponsor'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Sponsor->delete()) {
            $this->Session->setFlash(__('The sponsor has been deleted.'));
        } else {
            $this->Session->setFlash(__('The sponsor could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
