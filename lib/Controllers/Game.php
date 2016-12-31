<?php
namespace Controllers;

class Game extends \Controller{
	/**
	 * @var array
	 */
	private $_gameInfo = array();
	
	public function __construct(int $gameId) {
		$this->_gameInfo = \Models\Games::getGameDetails($gameId);
		$this->_setView();
	}
	
	private function _setView(){
		//enum('APPROVAL','BIDDING','DRAW_UP','PLAYING','FINISHED')
		switch ($this->_gameInfo['gameState']) {
			case 'APPROVAL':
			case 'BIDDING':
			case 'DRAW_UP':
			case 'PLAYING':
			case 'FINISHED':
				$this->_view = VIEWS . strtolower($this->_gameInfo['gameState']) . '.phtml';
				break;
			default:
				throw new Exception('No valid game state found');
		}
	}
}