function initializeBoard(){
	jQuery.each(gameInfo.hands, function(playerId, hand){
		jQuery.each(hand,function(index,card) {
			jQuery('.playerId' + playerId + ' .cards').append(
				"<img src='/statics/cards/" + card.rank + '_' + card.suit + ".png' />"
			);
		});
	});
}