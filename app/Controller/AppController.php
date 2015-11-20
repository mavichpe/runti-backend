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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
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

    public $components = array('Session', 'Auth' => array(
            'loginRedirect' => array('controller' => 'dashboard', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'Para continuar por favor Inicie sesion'
    ));
    Public $helpers = array('Session', 'Js');
    private $appPermission = array();
    public $roles = array('admin' => 'Administrador', 'runner' => 'Corredor');

    public function beforeFilter() {
        if (!$this->request->is('ajax') && $this->name != 'CakeError' && $this->here != Router::url(array('controller' => 'users', 'action' => 'login'))) {
            $this->Session->write('Auth.redirect', $this->here);
        }
        $this->Auth->deny();

        $usuario = $this->Auth->user();
        if ($this->isCallFromApp()) {
            $this->Auth->allow();
        } else {
            $this->setUpPermission();
            $this->applyACL();
        }

        if ($this->isCallFromApp()) {
            $this->response->header('Access-Control-Allow-Origin', '*');
            $this->response->header('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS');
            $this->response->header('Access-Control-Allow-Headers', 'Content-Type');
        }

        $this->set('roles', $this->roles);
    }

    private function applyACL() {
        $controller = strtolower($this->request->params['controller']);
        $action = strtolower($this->request->params['action']);

        $isAllow = $this->isAllow($controller, $action);
        switch ($isAllow) {
            case false:
                $this->rejectRequest();
                break;
            case true:
                break;
        }
    }

    public function isCallFromApp() {
        return isset($this->request->data['appKey']) && base64_decode($this->request->data['appKey']) == '8dtp.3YU261281Gmswam8qtea.V';
    }

    private function rejectRequest() {
        $this->Session->setFlash('Usted no tiene permisos para acceder a esta seccion');
        $this->redirect($this->referer());
    }

    public function isAllow($controller, $action) {
        if (isset($this->request->data['allow']) && $this->request->data['allow'])
            return true;
        $role = $this->Auth->user('role');
        if ($role != null) {
            $permission = $this->appPermission[$role];
            if (array_search('*', $permission['basic']) !== false)
                return true;
            if (array_search($controller, $permission['basic']) !== false)
                return true;
            if (array_search($controller . "/" . $action, $permission['basic']) !== false)
                return true;

            if (isset($permission['strict'])) {
                $refer = substr($this->referer(), strlen(Router::url('/', true)));
                $refer = implode('/', array_slice(explode('/', $refer), 0, 2));
                foreach ($permission['strict'] as $key => $exception) {
                    $key = array_search($refer, $exception);
                    if ($key !== false) {
                        if ($key == $controller || $key == ($controller . "/" . $action ))
                            return true;
                    }
                }
            }

            return false;
        } else {
            return true;
        }
    }

    public function setUpPermission() {
//permission for superadministrador 
        $this->appPermission['admin']['basic'][] = '*';

//permisos para corredores
        $this->appPermission['runner']['basic'][] = 'events';
        $this->appPermission['runner']['basic'][] = 'user/edit';
        $this->appPermission['runner']['basic'][] = 'users/login';
        $this->appPermission['runner']['basic'][] = 'users/logout';
    }

    protected function updateImage($data, $destenyPath, $filename) {
        if (!opendir($destenyPath))
            mkdir($destenyPath, 0775, true);
        if (isset($data['name'])) {
            $extencion = pathinfo($data['name'], PATHINFO_EXTENSION);
            move_uploaded_file($data['tmp_name'], $destenyPath . $filename . '.' . $extencion);
        }
    }

    protected function deleteImage($filename) {
        unlink($filename);
    }

    public function send_android_notification($title, $message, $route, $registration_ids, $user = 0) {
        $url = 'https://android.googleapis.com/gcm/send';
        $headers = array('Authorization: key=' . 'AIzaSyDHLN0WEnkx6MI1m1nQV_ar35bQfijbVMc', 'Content-Type: application/json');

        $notification_data = array('title' => $title, 'message' => $message, 'route' => $route, 'user' => $user);
        $notification_body = array('registration_ids' => $registration_ids, 'data' => $notification_data);

        $curl_notification = curl_init();

        curl_setopt($curl_notification, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_notification, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_notification, CURLOPT_POST, true);
        curl_setopt($curl_notification, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_notification, CURLOPT_POSTFIELDS, json_encode($notification_body));
        curl_setopt($curl_notification, CURLOPT_URL, $url);

        $result = curl_exec($curl_notification);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($curl_notification));
        }

        curl_close($curl_notification);
    }

    public function send_ios_notification($title, $message, $route, $registration_ids, $user = 0) {
        $appleApiUrl = 'ssl://gateway.sandbox.push.apple.com:2195';
        $privateKey = WWW_ROOT . 'ck.pem';
        $privateKeyPassPhrase = '8qtea.v';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $privateKey);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $privateKeyPassPhrase);


        foreach ($registration_ids as $deviceToken) {
            $fp = stream_socket_client($appleApiUrl, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);

            $body['aps'] = array(
                'alert' => array(
                    'body' => $message
                ),
                'sound' => 'default',
                'badge' => +1,
                'payload' => array(
                    'route' => $route,
                    'user' => $user
                )
            );

            $payload = json_encode($body);

            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            fwrite($fp, $msg, strlen($msg));
            fclose($fp);
        }
    }

}

?>