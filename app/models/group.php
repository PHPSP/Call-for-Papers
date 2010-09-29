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
	public $name = 'Group';
	
	/**
	 * Validation
	 *
	 * @var array
	 */
	public $validate = array(
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
	 * Behavior implementation.
	 *
	 * @var arrray
	 */
	public $actAs = array('Acl'=>array('type'=>'requester'));
	
	/**
	 * A group never has a parent node.
	 *
	 * @return null
	 * @author Augusto Pascutti
	 */
	public function parentNode() {
	    return null;
	}

    /**
     * Has many relation
     *
     * @var array
     */
	public $hasMany = array(
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