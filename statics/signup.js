$(document).ready(function(){ 
	$('#signUpForm').on('submit', function(event){
		
		var result = true;
		$('#signUpForm input').css('border-color','').each(function(index, elem){
			if($(elem).val() == ''){
				result = false;
				$(elem).css('border-color','red');
				$('#errorMsg').html('Fix the highlighted fields.');
			}
		});
		if($('#password').val() != $('#confirmPassword').val()) {
			$('#password, #password').css('border-color','red');
			$('#errorMsg').html('Password fields do not match.');
			result = false;
		}
		return result;
	});
});
