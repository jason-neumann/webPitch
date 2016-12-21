<?php
namespace Controllers;

class Game {
	/**
	 * @var array
	 */
	private $_gameInfo = array();
	
	/**
	 * @var string 
	 */
	private $_view = '';
	
	public function __construct(int $gameId) {
		$this->_gameInfo = \Models\Games::getGameDetails($gameId);
		$this->_setView();
	}
	
	public function render() {
		var_dump($this->_view);
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