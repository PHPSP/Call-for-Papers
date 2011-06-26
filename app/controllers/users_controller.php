<?php
/**
 * Users controller
 *
 * @package CfP.controllers
 * @author Augusto Pascutti
 */
class UsersController extends AppController {

	var $name = 'Users';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login','register','logout');
	}

	function index() {
		if ( $this->Session->check('Auth.User') ) {
		    $this->redirect(array('controller'=>'proposals'));
		}
	}

	function edit($id = null) {
	    $id = $this->Session->read('Auth.User.id');
	    
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), __('user',true)));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), __('user',true)));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('user',true)));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function login() {
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in!');
		}
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function register() {
		if (!empty($this->data)) {
			$password  = $this->data['User']['password'];
			$password2 = $this->Auth->password($this->data['User']['password2']);
			if ( $password == $password2 ) {
				$this->User->create();
				if ($this->User->save($this->data)) {
					$this->Session->setFlash(sprintf(__('The %s has been registered', true), __('user',true)));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), __('user',true)));
				}
			} else {
				
				$this->Session->setFlash(__('The passwords don\'t match',true));
			}
			$this->data['User']['password']  = '';
			$this->data['User']['password2'] = '';
		}
	}
}
?>