<?php
namespace Models;

class Players {
	static function getPlayersInfo(array $ids) {
		$players = array();
		$statement = \Utils::$db->prepare("
			SELECT
				id, name
			FROM
				users
			WHERE
				id IN (" . implode(',',$ids) . ")
		");
		$statement->execute();
		while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
			$players[$row['id']] = $row;
		}
		return $players;
	}
	
	/**
	 * 
	 * @param int $gameId
	 * @return type
	 */
	static function getGameDetails(int $gameId) {
		$statement = \Utils::$db->prepare("
			SELECT
				* 
			FROM
				games
			WHERE
				id = :gameId
		");
		$statement->execute(array(':gameId' => $gameId));
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}
}