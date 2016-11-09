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
	});
	//:eq(1) is to ensure you can't remove yourself from a team
	$('.team1 .user:eq(1), .team2 .user').on('click', function(event){
		$('.availableUsers [data-id=' + $(this).data('id') + ']').show();
		$(this)
			.addClass('empty')
			.html('')
			.removeData('id');
	});
});