<?php
class Area extends AppModel {
	var $name = 'Area';
	var $validate = array(
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
	var $locale = 'eng';
	
	var $actAs = array(
	        'Translate' => array(
	            'name' => "nameTranslation"
	        )
	    );
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Proposal' => array(
			'className' => 'Proposal',
			'foreignKey' => 'area_id',
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