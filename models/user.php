<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
	var $validate = array(
		'username' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'password' => array(
			'minLength' => array(
				'rule' => array('minLength', 6),
				'message' => 'You must enter a valid password with at least 6 characters',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email',
				'allowEmpty' => false,
				'required' => true
			),
		),
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Document' => array(
			'className' => 'Document',
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
	
	var $virtualFields = array(
		'full_name' =>	'CONCAT(User.first_name, " ", User.last_name)'
	);

}
