<?php
class AreasController extends AppController {

	var $name = 'Areas';

	function index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'area'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('area', $this->Area->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Area->create();
			if ($this->Area->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'area'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'area'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'area'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		    //$this->Area->locale = 'pt';
			if ($this->Area->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'area'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'area'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Area->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'area'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Area->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Area'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Area'));
		$this->redirect(array('action' => 'index'));
	}
}
?>