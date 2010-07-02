<?php
/**
 * Speaker model
 *
 * @package default
 * @author Augusto Pascutti
 */
class Speaker extends AppModel {
    /**
     * Model name
     *
     * @var string
     */
	public $name = 'Speaker';
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'firstName' => array(
                        'notempty' => array(
                                        'rule' => array('notempty'),
                                        'message' => 'This field cannot be empty.',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
        ),
        'lastName' => array(
                        'notempty' => array(
                                        'rule' => array('notempty'),
                                        'message' => 'This field cannot be empty.',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
        ),
		'rg' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'abstract' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'between' => array(
				'rule' => array('between', 100, 500),
				'message' => 'You must enter a text with a minimum of 100 characters and a maximum of 500',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	/**
	 * Behaviours declaration
	 *
	 * @var array
	 */
	var $actsAs= array(
		'Image'=>array(
			'fields'=>array(
				'image'=>array(
					'thumbnail'=>array('create'=>true),
					'resize'=>array(
									 'width'=>'310',
									 'height'=>'440',
						),
					'versions'=>array(
						array('prefix'=>'small',
									 'width'=>'145',
									 'height'=>'210',
						),
						array('prefix'=>'large',
									 'width'=>'310',
									 'height'=>'440',
						)
					)
				)
			)
		)
	);
	

    /**
     * Belongs to relation
     *
     * @var array
     */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Size' => array(
			'className' => 'Size',
			'foreignKey' => 'size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    /**
     * Has many relation
     *
     * @var array
     */
	public $hasMany = array(
		'Proposal' => array(
			'className' => 'Proposal',
			'foreignKey' => 'speaker_id',
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


    function beforeSave() {

        //Filter Twitter input to leave only username
        if(!empty($this->data['Speaker']['twitter'])) {
            $cleanupRegExp = "/(?:http\:\/\/)?(?:www\.)?(?:twitter\.com)?[\/]?(?:@)?([A-Za-z0-9_-]*)?/";
            $matches = array();

            $op = preg_match($cleanupRegExp, $this->data['Speaker']['twitter'], $matches);

            //If we found a match use it, otherwise leave it alone
            if ($op) {
                $this->data['Speaker']['twitter'] = $matches[1];
            }

        }

        return true;
    }

}
?>