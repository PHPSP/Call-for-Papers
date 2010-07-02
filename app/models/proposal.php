<?php
/**
 * Proposal model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Proposal extends AppModel {
    /**
     * Model name
     *
     * @var string
     */
	public $name = 'Proposal';
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'speaker_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'A speaker must be set',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'area_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'A theme should be set',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Every proposal should have a title',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'abstract' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must especify an abstract',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'time' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You must tell us how long your session will last',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    /**
     * Belongs to relation
     *
     * @var array
     */
	public $belongsTo = array(
		'Speaker' => array(
			'className' => 'Speaker',
			'foreignKey' => 'speaker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Level' => array(
			'className' => 'Level',
			'foreignKey' => 'level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/**
	 * Checks if the given proposal belongs to the given speaker
	 *
	 * @param int $speaker_id 
	 * @param int $proposal_id 
	 * @return boolean
	 * @author Augusto Pascutti
	 */
	public function checkSpeakerProposal($speaker_id, $proposal_id) {
	    $this->id = $proposal_id;
	    $this->read();
	    if ( ! isset($this->data['Speaker']['id']) 
	        || empty($this->data['Speaker']['id']) 
	        || $this->data['Speaker']['id'] != $speaker_id ) {
	            return false;
	    }
	        
	    return true;
	}
}