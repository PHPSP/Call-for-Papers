<?php
/**
 * Group model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Group extends AppModel {
    /**
     * Model name
     *
     * @var string
     */
	var $name = 'Group';
	
	/**
	 * Validation
	 *
	 * @var array
	 */
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    /**
     * Has many relation
     *
     * @var array
     */
	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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
?>