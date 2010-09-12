<?php
/**
 * Voting controller
 *
 * @package default
 * @author Augusto Pascutti
 */
class VotesController extends AppController {
    /**
     * Controller name
     *
     * @var string
     */
    public $name = "Votes";
    
    /**
     * Models to use
     *
     * @var array
     */
    public $uses = array('Vote', 'Proposal');
    
    /**
     * Before filter callback.
     * Allows every user to access this controller actions without login.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }
    
    /**
     * Registers a vote, so we do not show the same proposal to this user
     * again.
     *
     * @param int $proposal_id ID of the proposal 
     * @return void
     * @author Augusto Pascutti
     */
    protected function _registerVote($proposal_id) {
        if ( ! $this->Session->check('Vote.seen') ) {
            $this->Session->write('Vote.seen', array());
        }
        $votes = $this->Session->read('Votes.seen');
        $votes[$proposal_id] = $proposal_id;
        $this->Session->write('Vote.seen',$votes);
    }
    
    /**
     * Returns if the given proposal was already shown to the current user.
     *
     * @param int $proposal_id 
     * @return void
     * @author Augusto Pascutti
     */
    protected function _seenThisProposal($proposal_id) {
        if ( ! $this->Session->check('Vote.seen') ) {
            return false;
        }
        $votes = $this->Session->read('Votes.seen');
        return (boolean) isset($votes[$proposal_id]);
    }
    
    /**
     * Index action, shows the proposal to receive the vote.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function index() {
        $params   = array('order'=>array('RAND()'), 'limit'=>1);
        $proposal = $this->Proposal->find('all', $params);
        $proposal = array_pop($proposal);
        $salt     = Configure::read('Security.salt');
        $id       = $proposal['Proposal']['id'];
        // Prevents people from votting directly with the 'vote' action
        $key      = md5($salt.$id.microtime());
        
        if ( $this->_seenThisProposal($id) ) {
            $this->redirect('index');
        }
        
        $this->Session->write('Vote.key', $key);
        $this->set(compact('proposal', 'key'));
    }
    
    /**
     * Receives a vote for a proposal.
     * The user MUST come from the 'index' action, so the 'key' value in session
     * is set.
     *
     * @return void
     * @author Augusto Pascutti
     */
    public function vote() {
        $id   = ( isset($this->params['named']['id']) )    ? $this->params['named']['id']    : null ;
        $val  = ( isset($this->params['named']['value']) ) ? $this->params['named']['value'] : null;
        $key  = ( isset($this->params['named']['key']) )   ? $this->params['named']['key']   : null ;
        $_key = $this->Session->read('Vote.key');
        $id   = (int) $id;
        
        if ( empty($_key) || empty($id) || ! isset($val) || $_key != $key ) {
            $this->Session->setFlash(__("Your vote was not considered because of an error !",true));   
        } else {
            $data = array();
            $data['Vote']['proposal_id'] = (int) $id;
            $data['Vote']['vote']        = (int) (boolean) $val;

            $this->Vote->create();
            $this->Vote->save($data);
            $this->_registerVote($id);
            $this->Session->setFlash(__('Thank you for you vote !',true));
        }
        $this->redirect('index');
    }
}