<?php
/**
 * Level model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Level extends AppModel {
    /**
     * Model name
     *
     * @var string
     */
	public $name = 'Level';
	
	/**
	 * Display field for this model
	 *
	 * @var string
	 */
	public $displayField = "name";
	
	/**
	 * Validation
	 *
	 * @var array
	 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
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
	public $hasMany = array(
		'Proposal' => array(
			'className' => 'Proposal',
			'foreignKey' => 'level_id',
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