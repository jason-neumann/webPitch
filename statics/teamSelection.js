$(document).ready(function(){
	$('.availableUsers .user').on('click', function(event) {
		if($('.user.empty').length) {
			$('.user.empty:eq(0)')
				.removeClass('empty')
				.html($(this).html())
				.data('id',$(this).data('id'))
				.find('.fa')
					.removeClass('fa-arrow-circle-right')
					.addClass('fa-times-circle');
			$(this).hide();
		}
		
		if($('.user.empty').length == 0) {
			$('.submit').show();
		}
	});
	//:eq(1) is to ensure you can't remove yourself from a team
	$('.team1 .user:eq(1), .team2 .user').on('click', function(event){
		$('.availableUsers [data-id=' + $(this).data('id') + ']').show();
		$(this)
			.addClass('empty')
			.html('')
			.removeData('id');
		$('.submit').hide();
	});
	
	$('.submit').on('click', function() {
		var info = {
			'team1': [
				$('.team1 .user:eq(0)').data('id'),
				$('.team1 .user:eq(1)').data('id')
			],
			'team2': [
				$('.team2 .user:eq(0)').data('id'),
				$('.team2 .user:eq(1)').data('id')
			],
		};
		$.post('/createGame.php',info,function(){
			location.href='/index.php';
		});
	});
});