CREATE TABLE hands (
	gameId INT UNSIGNED NOT NULL,
    userId INT UNSIGNED,
    rank ENUM(
		'2','3','4','5','6','7','8','9','10','jack','queen','king','ace','joker'
	) NOT NULL,
	suit ENUM(
		'hearts', 'diamonds', 'spades', 'clubs', 'big', 'little'
	) NOT NULL,
    discarded BOOL NOT NULL DEFAULT FALSE,
    played BOOL NOT NULL DEFAULT FALSE
);