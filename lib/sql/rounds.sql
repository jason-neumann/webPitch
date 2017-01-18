CREATE TABLE rounds (
	gameId INT UNSIGNED NOT NULL,
    roundNumber INT UNSIGNED NOT NULL,
    dealerId INT UNSIGNED NOT NULL,
    player1Bid INT UNSIGNED NULL,
    player2Bid INT UNSIGNED NULL,
    player3Bid INT UNSIGNED NULL,
    player4Bid INT UNSIGNED NULL,
    trumpSuit ENUM('hearts', 'spades', 'diamonds', 'clubs') NULL
)