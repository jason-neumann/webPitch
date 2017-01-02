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
				
			},
			'json'
		);
	});
});