function initializeBoard(){
	jQuery.each(gameInfo.hand,function(index,card) {
		jQuery('.playerId' + gameInfo.playerId + ' .cards').append(
			"<img src='/statics/cards/" + card.rank + '_' + card.suit + ".png' />"
		);
	});
	jQuery('.playerId' + gameInfo.playerId).addClass('currentPlayer');
}