<?php

App::uses('AppController', 'Controller');

/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

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
        $this->Event->recursive = 0;
        $this->set('events', $this->Paginator->paginate());
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

    public function getListaEventos() {
        $this->autoRender = false;
        $eventos[0] = "Seleccione uno";
        $eventos = $eventos + $this->Event->find('list');
        $this->response->body(json_encode($eventos));
    }

    public function getTodosLosEventos() {
        $this->autoRender = false;
        $hoy = new DateTime();
        $eventos = $this->Event->find('all', array('conditions' => 'YEAR(Event.fecha) = ' . $hoy->format('Y'), 'order' => 'Event.fecha'));
        $response = array();
        foreach ($eventos as $evento) {
            $fecha = new DateTime($evento['Event']['fecha']);
            $response['byMonth'][$fecha->format('m')][] = $evento;
            $response['byId'][$evento['Event']['id']] = $evento;
        }
        $this->response->body(json_encode($response));
    }

    public function getProximosEventos() {
        $fecha = new DateTime();
        $this->autoRender = false;
        $this->response->body(json_encode($this->Event->find('all', array('conditions' => array("Event.fecha >= " => $fecha->format('Y-m-d')), 'order' => 'Event.fecha', 'limit' => 6))));
    }

    public function getEventosPorMes($mes) {
        $this->autoRender = false;
        $this->response->body(json_encode($this->Event->find('all', array('order' => 'Event.fecha',
                            'conditions' => array(
                                'extract(MONTH FROM Event.fecha) = ' . $mes,
                                'extract(YEAR FROM Event.fecha)  = ' . date("Y")
                            )
        ))));
    }

    public function getEvento($id) {
        $this->autoRender = false;
        $this->response->body(json_encode($this->Event->read(null, $id)));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null, $user = null) {
        $this->layout = "view";
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Invalid event'));
        }
        $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
        $evento = $this->Event->find('first', $options);
        $this->set('event', $evento);
        $this->set('customClass', "grey-theme");
        $this->set('title', $evento['Event']['nombre']);

        $this->loadModel('User');
        $user = $this->User->read(null, $user);
        $this->set('user', $user);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Event->create();
            if ($this->Event->save($this->request->data)) {
                $this->request->data['Event']['id'] = $this->Event->id;

                $this->edit($this->Event->id);
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
            }
        }
        $organizers = $this->Event->Organizer->find('list');
        $places = $this->Event->Place->find('list');
        $kitelemets = $this->Event->Kitelement->find('list');
        $this->set(compact('organizers', 'places', 'kitelemets'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $data = $this->request->data;
            $filePath = 'trips' . DS . $id . DS;
            $destenyPath = WWW_ROOT . 'img' . DS;
            $imagenes = array();

            foreach ($data['Trip'] as $key => &$trips) {
                if (isset($trips['mapa'])) {
                    $imageInfo = $trips['mapa'];
                    $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
                    if (strlen($extencion) == 0)
                        unset($trips['mapa']);
                    else if (!is_array($trips['mapa'])) {
                        $trips['mapa'] = '';
                    } else {
                        $trips['mapa']['nombre'] = 'mapa' . $key;
                        $imagenes[] = $trips['mapa'];
                        $trips['mapa'] = $filePath . 'mapa' . $key . '.' . $extencion;
                    }
                }

                if (isset($trips['altimetria'])) {
                    $imageInfo = $trips['altimetria'];
                    $extencion = pathinfo($imageInfo['name'], PATHINFO_EXTENSION);
                    if (strlen($extencion) == 0)
                        unset($trips['altimetria']);
                    else if (!is_array($trips['altimetria'])) {
                        $trips['altimetria'] = '';
                    } else {
                        $trips['altimetria']['nombre'] = 'altimetria' . $key;
                        $imagenes[] = $trips['altimetria'];
                        $trips['altimetria'] = $filePath . 'altimetria' . $key . '.' . $extencion;
                    }
                }
            }
            if ($this->Event->saveAssociated($data)) {
                $this->Session->setFlash(__('The event has been saved.'));
                foreach ($imagenes as $imagen) {
                    $this->updateImage($imagen, $destenyPath . $filePath, $imagen['nombre']);
                }
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
            $this->request->data = $this->Event->find('first', $options);
        }
        $organizers = $this->Event->Organizer->find('list');
        $places = $this->Event->Place->find('list');
        $kitelemets = $this->Event->Kitelement->find('list');
        $this->set(compact('organizers', 'places', 'kitelemets'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Event->delete()) {
            $this->Session->setFlash(__('The event has been deleted.'));
        } else {
            $this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
