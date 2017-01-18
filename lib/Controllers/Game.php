<?php
namespace Controllers;

class Game extends \Controller{
	/**
	 * @var array
	 */
	protected $_gameInfo = array();
	
	/**
	 * the number (1-4) the player is in this particular game
	 * @var int 
	 */
	protected $_playerNumber = 0;

	/**
	 * list of the players in the game that aren't the user
	 * @var array 
	 */
	protected $_players = array();
	
	/**
	 *
	 * @var array 
	 */
	protected $_hands = array();

	public function __construct(int $gameId) {
		$this->_gameInfo = \Models\Games::getGameDetails($gameId);
		$this->_players = \Models\Players::getPlayersInfo(array(
			$this->_gameInfo['player1Id'],
			$this->_gameInfo['player2Id'],
			$this->_gameInfo['player3Id'],
			$this->_gameInfo['player4Id'],
		));
		$this->_setViewAndStyles();
		$this->_setPlayerNumber();
		if($this->_gameInfo['gameState'] != 'APPROVAL') {
			$this->_hands = \Models\Games::getHands($gameId);
		}
	}
	
	public function getJSONgameInfo(){
		//this should only return gameInfo relevant to the current player
		//need info on the player id (or rework the html to always have this player at the bottom)
		return json_encode(array(
			'players' => $this->_players,
			'playerId' => \Utils::$userInfo['id'],
			'hand' => $this->_hands[\Utils::$userInfo['id']],
			'gameInfo' => $this->_gameInfo
		));
	}
	
	protected function _setViewAndStyles(){
		//enum('APPROVAL','BIDDING','DRAW_UP','PLAYING','FINISHED')
		switch ($this->_gameInfo['gameState']) {
			case 'BIDDING':
			case 'DRAW_UP':
			case 'PLAYING':
				$this->_view = VIEWS . 'gameBoard.phtml';
				$this->addCSS('/statics/play.css');
				$this->addJS('/statics/play.js');
				break;
			case 'APPROVAL':
				$this->addCSS('/statics/approval.css');
				$this->addJS('/statics/approval.js');
			case 'FINISHED':
				$this->_view = VIEWS . strtolower($this->_gameInfo['gameState']) . '.phtml';
				break;
			default:
				throw new Exception('No valid game state found');
		}
	}
	
	protected function _setPlayerNumber() {
		if(!$this->_gameInfo['id']) {
			throw new \Exception('Game info not set. Cannot determine player number');
		}
		
		for ($i = 1; $i <= 4; $i++) {
			if($this->_gameInfo['player' . $i . 'Id'] == \Utils::$userInfo['id']) {
				$this->_playerNumber = $i;
				break;
			}
		}
		
		if($this->_playerNumber == 0) {
			throw new \Exception('Current player is not a part of this game.');
		}
	}
}