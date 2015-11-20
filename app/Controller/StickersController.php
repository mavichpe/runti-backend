<?php

App::uses('AppController', 'Controller');

/**
 * Stickers Controller
 *
 * @property Sticker $Sticker
 * @property PaginatorComponent $Paginator
 */
class StickersController extends AppController {

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
        $this->Sticker->recursive = 0;
        $this->set('stickers', $this->Paginator->paginate());
    }

    public function getStickers($userdID) {
        $this->autoRender = false;
        $stickers = $this->Sticker->find('all', array('conditions' => array('Sticker.recibe ' => $userdID, "Sticker.estado" => 1)));
        $this->response->body(json_encode($stickers));
    }

    public function getUnViewStickers($userdID) {
        $this->autoRender = false;
        $stickers = $this->Sticker->find('all', array('conditions' => array('Sticker.recibe ' => $userdID, "Sticker.estado" => 0)));
        $this->response->body(json_encode($stickers));
    }

    public function viewSticker($stickerId) {
        $this->autoRender = false;
        $sticker = $this->Sticker->read(null, $stickerId);
        $sticker['Sticker']['estado'] = 1;
        $response['store'] = false;
        if ($this->Sticker->save($sticker))
            $response['store'] = true;
        $this->response->body(json_encode($response));
    }

    public function sendSticker() {
        $this->autoRender = false;
        $data = $this->request->data;
        $respuesta = array();
        $respuesta['datos'] = $data;

        $stickers = array();
        foreach ($data['User'] as $user) {
            $stickers[] = array(
                'Sticker' => array(
                    'enviado' => $data['Sticker']['enviado'],
                    'estado' => 0,
                    'recibe' => $user,
                    'sticker' => $data['Sticker']['sticker']
                )
            );
        }
        if ($this->Sticker->saveAll($stickers)) {
            $respuesta['store'] = true;
        } else
            $respuesta['store'] = false;

        $this->response->body(json_encode($respuesta));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Sticker->exists($id)) {
            throw new NotFoundException(__('Invalid sticker'));
        }
        $options = array('conditions' => array('Sticker.' . $this->Sticker->primaryKey => $id));
        $this->set('sticker', $this->Sticker->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Sticker->create();
            if ($this->Sticker->save($this->request->data)) {
                $this->Session->setFlash(__('The sticker has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sticker could not be saved. Please, try again.'));
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
        if (!$this->Sticker->exists($id)) {
            throw new NotFoundException(__('Invalid sticker'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Sticker->save($this->request->data)) {
                $this->Session->setFlash(__('The sticker has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The sticker could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Sticker.' . $this->Sticker->primaryKey => $id));
            $this->request->data = $this->Sticker->find('first', $options);
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
        $this->Sticker->id = $id;
        if (!$this->Sticker->exists()) {
            throw new NotFoundException(__('Invalid sticker'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Sticker->delete()) {
            $this->Session->setFlash(__('The sticker has been deleted.'));
        } else {
            $this->Session->setFlash(__('The sticker could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
