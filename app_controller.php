<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

	public $helpers = array('Html', 'Form', 'Session');
	
	public $components = array('Auth' => array(
                            'authorize' => 'actions',
                            'actionPath' => 'controllers/',
                            'loginAction' => array(
                                'controller' => 'users',
                                'action' => 'login',
                                'plugin' => false,
                                'admin' => false,
                                ),
                            ), 
                  'Acl', 'Session',
       );
	
	function beforeFilter() {
        $this->Auth->allow('index','view','display', 'add');
        $user = $this->Auth->user();
        if(!empty($user)) {
            Configure::write('User', $user[$this->Auth->getModel()->alias]);
        }
            
    }
    
    function beforeRender() {
        $user = $this->Auth->user();
        if(!empty($user)) {
            Configure::write('User', $user[$this->Auth->getModel()->alias]);
        }
        $this->set(compact('user'));
        
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'logout');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
    }
	
}