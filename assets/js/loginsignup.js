$(document).ready(function() {
	$('.btn_click').on('click',function(){
    	if($('#login_div').css('display')!='none'){
    		$('#signup_div').show().siblings('div').hide();
    		}
    	else if($('#signup_div').css('display')!='none'){
        	$('#login_div').show().siblings('div').hide();
   		}
	});
});
