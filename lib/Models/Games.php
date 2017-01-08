<?php
namespace Models;

class Games {
	static function getPlayerGamesWithTeamNames(int $playerId) {
		$statement = \Utils::$db->prepare("SELECT 
	gameId,
	gameState,
	p2.name AS partnerName,
	CONCAT(p3.name, ' & ', p4.name) AS opponents
FROM
	((SELECT
		id AS gameId,
		gameState,
		player2Id AS partnerId,
		player3Id AS opponent1Id,
		player4Id AS opponent2Id
	FROM games
	WHERE
		player1Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		gameState,
		player1Id AS partnerId,
		player3Id AS opponent1Id,
		player4Id AS opponent2Id
	FROM games
	WHERE
		player2Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		gameState,
		player4Id AS partnerId,
		player1Id AS opponent1Id,
		player2Id AS opponent2Id
	FROM games
	WHERE
		player3Id = :playerId)
	UNION
	(SELECT
		id AS gameId,
		gameState,
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
	 * deal 9 cards to each player, store them in the db and return them
	 * @param int $gameId
	 * @param array $players
	 */
	static function deal(int $gameId, array $players) {
		$statement = \Utils::$db->prepare("
			INSERT INTO hands
				(gameId, rank, suit)
			SELECT 
				:gameId as gameId, rank, suit
			FROM
				cards
			ORDER BY RAND()
			LIMIT 36");
		$statement->execute(array(':gameId' => $gameId));
		$statement = \Utils::$db->prepare("
			UPDATE
				hands
			SET
				userId=:userId
			WHERE
				gameId=:gameId
				AND userId IS NULL
			LIMIT 9");
		$statement->execute(array(
			':gameId' => $gameId,
			':userId' => $players[0]
		));
		$statement->execute(array(
			':gameId' => $gameId,
			':userId' => $players[1]
		));
		$statement->execute(array(
			':gameId' => $gameId,
			':userId' => $players[2]
		));
		$statement->execute(array(
			':gameId' => $gameId,
			':userId' => $players[3]
		));
	}
	
	static function getHands(int $gameId) {
		$return = array();
		$statement = \Utils::$db->prepare(
			"SELECT * FROM hands WHERE gameId=:gameId"
		);
		$statement->execute(array(':gameId' => $gameId));
		while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
			$return[$row['userId']][] = $row;
		}
		return $return;
	}
	
	/**
	 * 
	 * @param int $gameId
	 * @param string $state
	 */
	static function updateGameState(int $gameId, string $state) {
		$statement = \Utils::$db->prepare(
			"UPDATE games SET gameState = :state WHERE id = :gameId"
		);
		$statement->execute(array(':gameId' => $gameId, ':state' => $state));
	}
	
	/**
	 * 
	 * @param int $gameId
	 * @return array
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
	
	/**
	 * 
	 * @param int $gameId
	 * @param int $playerNumber
	 * @param bool $approved
	 */
	static function setPlayerApproval(int $gameId, int $playerNumber, bool $approved) {
		$statement = \Utils::$db->prepare("
			UPDATE
				games
			SET
				player" . $playerNumber . "Approves = :approved
			WHERE
				id = :gameId
		");
		$statement->execute(array(':gameId' => $gameId, ':approved' => $approved));
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}
}