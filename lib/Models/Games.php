<?php
namespace Models;

class Games {
	static function getPlayerGamesWithTeamNames(int $playerId) {
		$statement = \Utils::$db->prepare("SELECT 
	gameId,
    p2.name AS partnerName,
    CONCAT(p3.name, ' & ', p4.name) AS opponents
FROM
	((SELECT
		id AS gameId,
		player2Id AS partnerId,
		player3Id AS opponent1Id,
		player4Id AS opponent2Id
	FROM games
	WHERE
		player1Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		player1Id AS partnerId,
		player3Id AS opponent1Id,
		player4Id AS opponent2Id
	FROM games
	WHERE
		player2Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		player4Id AS partnerId,
		player1Id AS opponent1Id,
		player2Id AS opponent2Id
	FROM games
	WHERE
		player3Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		player3Id AS partnerId,
		player1Id AS opponent1Id,
		player2Id AS opponent2Id
	FROM games
	WHERE
		player4Id = :playerId)) AS games
	JOIN users AS p2 ON p2.id=games.partnerId
	JOIN users AS p3 ON p3.id=games.opponent1Id
	JOIN users AS p4 ON p4.id=games.opponent2Id;");
		$statement->execute(array(':playerId' => $playerId));
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
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