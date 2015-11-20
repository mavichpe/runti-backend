<?php

App::uses('AppController', 'Controller');

/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class ImagesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("view");
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Image->recursive = 0;
        $this->set('images', $this->Paginator->paginate());
    }

    public function getImages($userID) {
        $this->autoRender = false;
        $this->Image->recursive = -1;
        $this->response->body(json_encode($this->Image->find('all', array('conditions' => "Image.user_id = $userID", 'order' => "Image.created desc"))));
    }

    public function getImage($imageId) {
        $this->autoRender = false;
        $this->Image->recursive = 2;
        $this->response->body(json_encode($this->Image->find('first', array('conditions' => 'Image.id =' . $imageId))));
    }

    public function saveImage($imageId, $userId) {
        $this->autoRender = false;
        $this->Image->recursive = -1;
        $options = array('conditions' => array('Image.' . $this->Image->primaryKey => $imageId));
        $data = $this->Image->find('first', $options);
        unset($data['Image']['id']);
        unset($data['Image']['created']);
        $data['Image']['user_id'] = $userId;
        $this->Image->create();
        if ($this->Image->save($data)) {
            $this->response->body(json_encode(array('store' => true)));
        } else {
            $this->response->body(json_encode(array('store' => false)));
        }
    }

    public function getComments($imageId) {
        $this->autoRender = false;
        $this->loadModel('Imagescomment');
        $this->response->body(json_encode($this->Imagescomment->find('all', array('conditions' => array('Imagescomment.image_id =' . $imageId)))));
    }

    public function addComment() {
        $this->autoRender = false;
        $this->loadModel('Imagescomment');
        $response = array();
        $this->Imagescomment->create();
        if (($coment = $this->Imagescomment->save($this->request->data))) {
            $data = $this->Imagescomment->find('first', array('conditions' => 'Imagescomment.id =' . $this->Imagescomment->id));
            $response['store'] = true;
            $response['text'] = $data['Imagescomment']['comment'];
            $response['date'] = $data['Imagescomment']['created'];
            $response['username'] = $data['User']['nombre'] . ' ' . $data['User']['apellido'];
            $response['fcid'] = $data['User']['fcid'];
        } else {
            $response['store'] = false;
        }
        $this->response->body(json_encode($response));
    }

    public function addImage() {
        $this->autoRender = false;
        $data = $this->request->data;
        $filePath = 'images' . DS . 'userimg' . DS;
        $destenyPath = WWW_ROOT . 'img' . DS;
        $imagenes = array();
        $response = array();
        $response['store'] = false;

        foreach ($data['Image'] as &$imagen) {
            $imgToInsert = array();
            $imageInfo = $imagen['url'];
            $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
            $nombre = pathinfo($imageInfo['name'], PATHINFO_FILENAME);
            if (strlen($extencion) != 0 && is_array($imagen['url'])) {
                $imagen['nombre'] = time() . $nombre;
                $imgToInsert['Image']['url'] = $filePath . $imagen['nombre'] . '.' . $extencion;
                $imgToInsert['Image']['user_id'] = $data['userId'];
                $imagenes[] = $imgToInsert;
            }
        }
        $response['img'] = $imagenes;
        if (count($imagenes)) {
            if ($this->Image->saveAll($imagenes)) {
                $response['store'] = true;
                foreach ($data['Image'] as $imagen) {
                    $this->updateImage($imagen['url'], $destenyPath . $filePath, $imagen['nombre']);
                }
            }
        }

        $this->response->body(json_encode($response));
    }

    public function getLikes($imageId) {
        $this->autoRender = false;
        $this->loadModel('Imageslike');
        $this->Imageslike->recursive = -1;
        $this->response->body(json_encode($this->Imageslike->find('all', array('conditions' => array('Imageslike.image_id =' . $imageId)))));
    }

    public function getLikeStatus($imageId, $userId) {
        $this->autoRender = false;
        $this->loadModel('Imageslike');
        $this->Imageslike->recursive = -1;
        $like = $this->Imageslike->find('count', array('conditions' => 'Imageslike.image_id =' . $imageId . ' and Imageslike.user_id =' . $userId));
        $response['liked'] = $like >= 1 ? 1 : 0;
        $this->response->body(json_encode($response));
    }

    public function setLike() {
        $this->autoRender = false;
        $this->loadModel('Imageslike');
        $datos = $this->request->data;
        if ($datos['Imageslike']['like']) {
            if ($this->Imageslike->save($datos)) {
                $response['store'] = true;
                $response['liked'] = true;
            } else {
                $response['store'] = false;
            }
        } else {
            if ($this->Imageslike->deleteAll('Imageslike.image_id =' . $datos['Imageslike']['image_id'] . ' and Imageslike.user_id =' . $datos['Imageslike']['user_id'])) {
                $response['store'] = true;
                $response['liked'] = false;
            } else {
                $response['store'] = false;
            }
        }

        $this->response->body(json_encode($response));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->layout = "view";
        if (!$this->Image->exists($id)) {
            throw new NotFoundException(__('Invalid image'));
        }
        $options = array('conditions' => array('Image.' . $this->Image->primaryKey => $id));
        $this->set('title', 'Imagen Runti');
        $this->set('image', $this->Image->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            unset($data['Image']['url']);
            $this->Image->create();
            if ($this->Image->save($data)) {
                $this->request->data['Image']['id'] = $this->Image->id;
                $this->edit($this->Image->id);
            } else {
                $this->Session->setFlash(__('The image could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('Album');
        $users = array(0 => 'Runti') + $this->Image->User->find('list');
        $albums = array(0 => 'Seleccione una ') + $this->Album->find('list');
        $this->set(compact('users', 'albums'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Image->exists($id)) {
            throw new NotFoundException(__('Invalid image'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            $filePath = 'runner-images' . DS . $id . DS;
            $destenyPath = WWW_ROOT . 'img' . DS;
            $image = null;

            $imageInfo = $data['Image']['url'];
            $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
            if (strlen($extencion) == 0)
                unset($data['Image']['url']);
            else if (!is_array($data['Image']['url'])) {
                $data['Image']['url'] = '';
            } else {
                $data['Image']['url']['nombre'] = 'image' . $id;
                $image = $data['Image']['url'];
                $data['Image']['url'] = $filePath . 'image' . $id . '.' . $extencion;
            }
            if ($this->Image->save($data)) {
                $this->Session->setFlash(__('The image has been saved.'));
                if ($image != null) {
                    $this->updateImage($image, $destenyPath . $filePath, $image['nombre']);
                }
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The image could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Image.' . $this->Image->primaryKey => $id));
            $this->request->data = $this->Image->find('first', $options);
        }
        $this->loadModel('Album');

        $users = array(0 => 'Runti') + $this->Image->User->find('list');
        $albums = array(0 => 'Seleccione una ') + $this->Album->find('list');
        $this->set(compact('users', 'albums'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Image->id = $id;
        if (!$this->Image->exists()) {
            throw new NotFoundException(__('Invalid image'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Image->delete()) {
            $this->Session->setFlash(__('The image has been deleted.'));
        } else {
            $this->Session->setFlash(__('The image could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
