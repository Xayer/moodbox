$(document).ready(function() {

		$('#status-box').hide();
		$('.category li .info-box').hide();
		$('.category').hide();
		$('#register').hide();
		$('#login').hide();
		
	$('#header_compose').click(function(){
	
		$('#status-box').slideToggle('fast');
		$('.category').slideToggle('fast');
		$('.large_button').fadeToggle('fast');
		
	});
	
	$("#submit").click(function(){
		$(".error").hide();
		var error = false;
		var MoodVal = $("#mood").val();
		if(MoodVal == ''){
		$("#mood").after('<span class="error">Please Enter Your Mood text</span>');
		error = true;
		}
		if(error == true) {return false;}
	
	});

	$('.large_button:nth-child(1)').click(function(){
		$('#register').slideToggle('fast');
	});
	
	$('.large_button:nth-child(2)').click(function(){
		$('#login').slideToggle('fast');
	});
});