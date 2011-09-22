<?php
class ClientsController extends AppController {

	var $name = 'Clients';

	function index() {
		$this->Client->recursive = 0;
		$this->set('clients', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid client', true), array('action' => 'index'));
		}
		$this->set('client', $this->Client->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Client->create();
			if ($this->Client->save($this->data)) {
				$this->flash(__('Client saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid client', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Client->save($this->data)) {
				$this->flash(__('The client has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Client->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid client', true)), array('action' => 'index'));
		}
		if ($this->Client->delete($id)) {
			$this->flash(__('Client deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Client was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
