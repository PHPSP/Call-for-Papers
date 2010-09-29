<?php
/**
 * Speakers controller.
 *
 * @package default
 * @author Augusto Pascutti
 */
class SpeakersController extends AppController {
    /**
     * Controller name
     *
     * @var string
     */
	public $name = 'Speakers';
	/**
	 * Models to use in this controller
	 *
	 * @var array
	 */
	public $uses = array('Speaker','Proposal');
	
	/**
	 * Executed before the controller method.
	 *
	 * @see AppController::beforeFilter()
	 * @return void
	 * @author Augusto Pascutti
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$action                  = $this->params['action'];
		$user_id                 = $this->Session->read('Auth.User.id');
		$this->Speaker->User->id = $user_id;
		$speaker                 = $this->Speaker->find(array('user_id' => $user_id));
		// Check: user has a speaker profile
		if ( $action != 'add' && empty($speaker) ) {
			$this->redirect('add');
		} else if ( ! empty($speaker) && $action != 'edit' && $action != 'view' ) {
		    $this->redirect('edit');
		}
	}
	
	/**
	 * Index action, redirects to speaker edit.
	 *
	 * @return void
	 * @author Augusto Pascutti
	 */
	function index() {
		$this->redirect('edit');
	}

    /**
     * Adds speaker data to the user who is logged in.
     *
     * @return void
     * @author Augusto Pascutti
     */
	public function add() {
		$user_id = $this->Session->read('Auth.User.id'); // logged user
		
		if (!empty($this->data)) {
			$this->data['Speaker']['user_id'] = $user_id;
			$this->Speaker->create();
			if ($this->Speaker->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true),  __('speaker',true)));
				$this->redirect(array('controller'=>'proposals', 'action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('speaker',true)));
			}
		}
		$users   = $this->Speaker->User->find('list');
		$sizes   = $this->Speaker->Size->find('list');
		$this->set(compact('users','user_id','sizes'));
	}

    /**
     * Edit speaker data of the user who is logged in
     *
     * @return void
     * @author Augusto Pascutti
     */
	public function edit() {
		$id = $this->Session->read('Auth.User.id');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true),  __('speaker',true)));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Speaker->save($this->data)) {
				$this->Session->setFlash(__('Your information has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Your information could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
		    $speaker = $this->Speaker->find(array('user_id'=>$id));
			$this->data = $speaker;
		}
		
		$users = array($id=>$id);
		$sizes   = $this->Speaker->Size->find('list');
		$this->set(compact('users','sizes'));
	}
	
	/**
	 * Views a detail of a given speaker.
	 *
	 * @return void
	 * @author Augusto Pascutti
	 */
	public function view() {
	    $id = ( isset($this->params['named']['speaker_id']) ) ? $this->params['named']['speaker_id'] : null ;
	    
	    if ( is_null($id) ) {
	        $this->Session->setFlash(__('Speaker not specified!', true));
	    }
	    
	    $speaker = $this->Speaker->findById($id);
	    if ( count($speaker) <= 0 ) {
	        $this->Session->setFlash(__('Speaker not found', true));
	    }
	    
	    $proposalsCond = array('Speaker.id'=>$id);
	    $proposals = $this->paginate('Proposal',$proposalsCond);
	    
	    $this->set(compact('speaker','proposals'));
	}
}