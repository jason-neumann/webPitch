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
		\Models\Games::setPlayerApproval(
			$this->_data['gameId'],
			$this->_data['playerNumber'],
			$this->_data['approved']
		);
		
		$gameInfo = \Models\Games::getGameDetails($this->_data['gameId']);
		if($gameInfo['player2Approves'] && $gameInfo['player3Approves'] && $gameInfo['player4Approves']) {
			//start first round
			\Models\Games::startRound($this->_data['gameId'], 1);
			\Models\Games::deal(
				$this->_data['gameId'],
				array(
					$gameInfo['player1Id'],
					$gameInfo['player2Id'],
					$gameInfo['player3Id'],
					$gameInfo['player4Id']
				)
			);
			\Models\Games::updateGameState($this->_data['gameId'], 'BIDDING');
			
			/**
			 * @TODO: instantiate the game controller,
			 * have it build the bidding view, and return that html
			 */
			
		}
	}
}
