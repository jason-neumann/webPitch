$(document).ready(function(){
	$('.playerApproves, .playerRejects').on('click',function(){
		$.post(
			'ajax.php',
			{
				'action':'setApproval',
				'gameId':$('#gameId').val(),
				'playerNumber':$('#playerNumber').val(),
				'approved':$(this).hasClass('playerApproves')
			},
			function(response){
				$('.approvalBox').html("<h2>Great! Check back later to see if everyone is ready.</h2>")
				$('[data-id=' + $('#playerId').val() + '] .status').html('Ready to Play!');
			}
		);
	});
});