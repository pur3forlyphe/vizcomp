<?php
class Client extends AppModel {
	var $name = 'Client';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Please enter a valid name',
				'allowEmpty' => false,
				'required' => false
			),
		),
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Document' => array(
			'className' => 'Document',
			'foreignKey' => 'client_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'client_id',
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

}
