<?php
/**
 * Proposals controller
 *
 * @package default
 * @author Augusto Pascutti
 */
class ProposalsController extends AppController {
    /**
     * Controller name
     *
     * @var string
     */
	public $name = 'Proposals';
	/**
	 * Models to load
	 *
	 * @var array
	 */
    public $uses = array('Proposal','Speaker');
    /**
     * Logged speaker id
     *
     * @var int
     */
    public $speakerId = null;
    
    /**
     * Method executed before the controller method is called.
     *
     * @see AppController::beforeFilter()
     * @return void
     * @author Augusto Pascutti
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $speaker = $this->Speaker->findByUserId($this->Session->read('Auth.User.id'));
        
        // A speaker profile doesn't exists, guide the user to create it
        if ( ! $speaker ) {
            $this->redirect(array('controller'=>'speakers'));
            return;
        }
        $this->speakerId = $speaker['Speaker']['id'];
        $this->set('speaker_id',$this->speakerId);
        
        // checks if the given proposal id is from the current speaker
        $this->_checkProposal();
        
        $times   = array('60' => '60min',
                         '90' => '90min');
        $this->set(compact('times'));
    }
    
    /**
     * Checks if the proposal passed is from the current user
     *
     * @return void
     * @author Augusto Pascutti
     */
    protected function _checkProposal($id = null) {
        $allowedActions = array('index','add');
        if ( in_array($this->params['action'],$allowedActions) ) {
            return;
        }
        $id = ( is_null($id) )? $this->params['named']['id'] : $id ;
        if ( empty($id) ||
             ! $this->Proposal->checkSpeakerProposal($this->speakerId, $id) 
        ) {
            $this->Session->setFlash(__('The given proposal does not belongs to you!',true));
            $this->redirect(array('action'=>'index'));
            return;
        }
    }
    
    /**
     * Lists proposals from the logged user.
     *
     * @return void
     * @author Augusto Pascutti
     */
	public function index() {
		$this->Proposal->recursive = 0;
		$conds = array('Proposal.speaker_id' => $this->speakerId);
		$this->set('proposals', $this->paginate('Proposal', $conds));
	}

    /**
     * Adds a new proposal for the logged user.
     *
     * @return void
     * @author Augusto Pascutti
     */
	public function add() {
		if (!empty($this->data)) {
		    $this->data['Proposal']['speaker_id'] = $this->speakerId;
			$this->Proposal->create();
			if ($this->Proposal->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), __('proposal',true)));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('proposal',true)));
			}
		}
		$areas  = $this->Proposal->Area->find('list');
		$levels = $this->Proposal->Level->find('list');
		$this->set(compact('areas','levels'));
	}

    /**
     * Edits a given proposal.
     * The given proposal must belongs to the logged user.
     *
     * @return void
     * @author Augusto Pascutti
     */
	public function edit() {
	    $id = ( isset($this->params['named']['id']) ) ? $this->params['named']['id'] : null ;
	    $this->_checkProposal($id);
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), __('proposal',true)));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		    $this->data['Proposal']['speaker_id'] = $this->speakerId;
			if ($this->Proposal->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), __('proposal',true)));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('proposal',true)));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proposal->read(null, $id);
		}
		$speakers = $this->Proposal->Speaker->find('list');
		$areas    = $this->Proposal->Area->find('list');
		$levels   = $this->Proposal->Level->find('list');
		$this->set(compact('speakers','levels','areas'));
	}

    /**
     * Deletes a given proposal.
     * The given proposal must belongs to the logged user.
     *
     * @param int $id 
     * @return void
     * @author Augusto Pascutti
     */
	public function delete() {
	    $id = ( isset($this->params['named']['id']) ) ? $this->params['named']['id'] : null ;
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'proposal'));
			$this->redirect(array('action'=>'index'));
		}
		$this->_checkProposal($id);
		if ($this->Proposal->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Proposal'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Proposal'));
		$this->redirect(array('action' => 'index'));
	}
}