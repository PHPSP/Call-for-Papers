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
     * Behavior implementation
     *
     * @var array
     */
    public $actAs = array('Acl' => array('type'=>'requester'));

    /**
     * Returns the parent from this user, if exists, the Group.
     *
     * @return array
     * @author Augusto Pascutti
     */
    public function parentNode() {
        if ( $this->id && $empty($this->data) ) {
            return null;
        }
        
        if ( isset($this->data['User']['group_id']) ) {
            $group_id = $this->data['User']['group_id'];
        } else {
            $group_id = $this->field('group_id');
        }
        
        if ( ! empty($group_id) ) {
            return array('Group'=>array('id'=>$group_id));
        }
        return null;
    }
    
    /**
     * Binds the User's permission always to the Group.
     * This makes the Acl Behavior to not update the Aros table every time
     * a users is added, because only the Group permissions matter, there is no 
     * per-user permission setting.
     *
     * @param string $user 
     * @return void
     * @author Augusto Pascutti
     */
    public function bindNode($user) {
        return array('Group'=>array('id'=>$user['User']['group_id']));
    }

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
    
    /**
     * Belongs to relation
     *
     * @var array
     */
   public $belongsTo = array(
       'Group' => array(
           'className' => 'Group',
           'foreignKey' => 'group_id',
           'conditions' => '',
           'fields' => '',
           'order' => ''
       )
   );


}