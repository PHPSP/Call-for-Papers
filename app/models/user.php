<?php
/**
 * User model
 *
 * @package default
 * @author Augusto Pascutti
 */
class User extends AppModel {
    /**
     * name of the model
     *
     * @var string
     */
	public $name = 'User';
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
			    'rule' => array('isUnique'),
			    'message' => 'Every email needs to be unique'
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must define a password',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule' => array('between',5,50),
				'message' => 'Your password should have more than five characters',
			),
		),
	);

    /**
     * Has many association
     *
     * @var string
     */
	public $hasMany = array(
		'Speaker' => array(
			'className' => 'Speaker',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	

}