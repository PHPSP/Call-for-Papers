<?php
/**
 * Sizes model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Size extends AppModel {
    /**
     * Name of the model
     *
     * @var string
     */
	public $name = 'Size';
	
	/**
	 * Description column for model
	 *
	 * @var string
	 */
	public $displayField = "description";
	
	/**
	 * Validation
	 *
	 * @var array
	 */
	public $validate = array(
		'description' => array(
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
     * has many association
     *
     * @var array
     */
	public $hasMany = array(
		'Speaker' => array(
			'className' => 'Speaker',
			'foreignKey' => 'size_id',
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