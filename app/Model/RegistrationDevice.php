<?php

App::uses('AppModel', 'Model');

/**
 * RegistrationDevice Model
 *
 * @property User $User
 * @property Registration $Registration
 */
class RegistrationDevice extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'foreignKey' => 'user_id'
        ),
    );

}
