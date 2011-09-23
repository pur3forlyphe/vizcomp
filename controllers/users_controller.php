<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Auth');
	
	function login() {
		if(
                !empty($this->data) &&
                !empty($this->Auth->data['User']['username']) &&
                !empty($this->Auth->data['User']['password'])
            ){
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $this->Auth->data['User']['username'],
                        'User.password' => $this->Auth->data['User']['password']
                    ),
                    'recursive' => -1
                ));
					
                if(!empty($user) && $this->Auth->login($user)){

                } else {
                 
				   $this->Session->setFlash($this->Auth->loginError, $this->Auth->flashElement, array(), 'auth');
                }
				
			$this->redirect(array('controller' => 'documents', 'action' => 'index'));
			
            }
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$clients = $this->User->Client->find('list');
		$this->set(compact('groups', 'clients'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$clients = $this->User->Client->find('list');
		$this->set(compact('groups', 'clients'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	public static function get($field = null) {
        $user = Configure::read('User');
        if (empty($user) || (!empty($field) && !array_key_exists($field, $user))) {
            return false;
        }
    }

    function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    } 
    
    function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id'] );
    }
	
}
