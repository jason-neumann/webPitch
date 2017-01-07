CREATE TABLE hands (
	gameId INT UNSIGNED NOT NULL,
    userId INT UNSIGNED,
    rank ENUM(
		'2','3','4','5','6','7','8','9','10','Jack','Queen','King','Ace','Joker'
	) NOT NULL,
	suit ENUM(
		'Hearts', 'Diamonds', 'Spades', 'Clubs', 'Big', 'Little'
	) NOT NULL,
    discarded BOOL NOT NULL DEFAULT FALSE,
    played BOOL NOT NULL DEFAULT FALSE
);