<?php
/**
 * Vote model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Vote extends AppModel {
    /**
     * Model name
     *
     * @var string
     */
	public $name = 'Vote';
	/**
	 * Validation
	 *
	 * @var array
	 */
	public $validate = array(
		'proposal_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vote' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    /**
     * Belongs to association
     *
     * @var string
     */
	public $belongsTo = array(
		'Proposal' => array(
			'className' => 'Proposal',
			'foreignKey' => 'proposal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}