<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        /* 'Acl', */
        'Auth' => array(
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'loginAction' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'No esta autorizado para acceder a esta seccion ',
        /* 'authorize' => array(
          'Actions' => array('actionPath' => 'controllers')
          ) */
        ),
        'Session');
    Public $helpers = array('Session', 'Js', 'Html');
    private $appPermission = array();
    public $nombreMeses = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

    public function beforeFilter() {
        $auth = $this->Session->read('Auth');
        if (!isset($auth['User']['id']) && strtolower($this->request->params['action']) != 'nopermission') {
            $usuario = $_SERVER['LOGON_USER'];
            //$usuario = 'uidext0041';
            //$usuario = 'uidcr00126';
            if (isset($usuario)) {
                if (!$this->Session->check('domain.user')) {
                    $this->Session->write('domain.user', $usuario);
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
            }
        }
        $this->setUpDynamicPagination();
        $this->setUpPermission();
        $this->Auth->allow();
        $this->applyACL();
        $this->set('nombreMeses', $this->nombreMeses);
    }

    private function setUpDynamicPagination() {
        $limit = 10;
        if (isset($this->params['named']['filter_limit']))
            $limit = $this->params['named']['filter_limit'];
        else if (isset($this->request->data['filter_limit']))
            $limit = $this->request->data['filter_limit'];
        if (isset($this->Paginator)) {
            $this->Paginator->settings['limit'] = $limit;
        }
    }

    private function applyACL() {
        $controller = strtolower($this->request->params['controller']);
        $action = strtolower($this->request->params['action']);

        if (!$this->isAllow($controller, $action)) {
            $this->Session->setFlash(__('Usted no tiene permisos para acceder a esta seccion'));
//$this->redirect($this->request->referer());
            $group = $this->Auth->user('group_id');
            if ($group == 1)
                $this->redirect(array('controller' => 'dashboard', 'action' => 'administration'));
            else
                $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
    }

    public function isAllow($controller, $action) {
        $group = $this->Auth->user('group_id');
        if ($group != null) {
            $permission = $this->appPermission[$group];
            if (array_search($controller, $permission) !== false)
                return true;
            if (array_search($controller . "/" . $action, $permission) !== false)
                return true;
            return false;
        }else {
            return true;
        }
    }

    public function setUpPermission() {
//permission for administrador group id 1
        $this->appPermission[1][] = 'dashboard/administration';
        $this->appPermission[1][] = 'users';
        $this->appPermission[1][] = 'agents';
        $this->appPermission[1][] = 'bitacoras';
        $this->appPermission[1][] = 'calendars';
        $this->appPermission[1][] = 'comments';
        $this->appPermission[1][] = 'theoristkms';
        $this->appPermission[1][] = 'actualkms';
        $this->appPermission[1][] = 'agentsusers';
        $this->appPermission[1][] = 'routes/updatekm';
        $this->appPermission[1][] = 'routes/index';
        $this->appPermission[1][] = 'routes/edit';

//permission for supervisor group id 2
        $this->appPermission[2][] = 'actualkms';
        $this->appPermission[2][] = 'agents';
        $this->appPermission[2][] = 'routes/insertkm';
        $this->appPermission[2][] = 'users/login';
        $this->appPermission[2][] = 'users/logout';
        $this->appPermission[2][] = 'users/nopermission';
        $this->appPermission[2][] = 'dashboard/index';
    }

    /**
     * Este metodo genera un periodo de fechas basado en la informacion de los parametros
     * 
     *
     * @param string $startDate
     * @param string $finishDate
     * @return DatePeriod
     */
    protected function generateCalendarBetweenDates($startDate, $finishDate) {
        $startDate = new DateTime($startDate);
        $finishDate = new DateTime($finishDate);
        $finishDate = $finishDate->modify('+1 day');

        $interval = DateInterval::createFromDateString('1 day');
        return new DatePeriod($startDate, $interval, $finishDate);
    }

}
