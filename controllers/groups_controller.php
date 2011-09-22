<?php
class GroupsController extends AppController {

	var $name = 'Groups';

	function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid group', true), array('action' => 'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Group->create();
			if ($this->Group->save($this->data)) {
				$this->flash(__('Group saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid group', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Group->save($this->data)) {
				$this->flash(__('The group has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid group', true)), array('action' => 'index'));
		}
		if ($this->Group->delete($id)) {
			$this->flash(__('Group deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Group was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
