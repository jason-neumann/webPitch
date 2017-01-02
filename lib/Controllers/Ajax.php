<?php
namespace Controllers;

class Ajax {
	/**
	 * the data passed in the ajax call
	 * @var array 
	 */
	protected $_data = array();
	
	public function __construct() {
		$this->_data = $_POST;
	}
	public function setApproval() {
		var_dump($this->_data);
		\Models\Games::setPlayerApproval(
			$this->_data['gameId'],
			$this->_data['playerNumber'],
			$this->_data['approved']
		);
	}
}
