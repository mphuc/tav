$(function(){
	'use strict';
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
	var _validate = {};
	var _fake_loading_show = function(){
		$('#fake_loading').fakeLoaderServer({
            timeToHide: 99999999999, //Time in milliseconds for fakeLoader disappear
            zIndex: "999999999", //Default zIndex
            spinner:"spinner3",
            bgColor: "rgba(0,0,0,0.5)", //Hex, RGB or RGBA colors
        });
	};
	var _fake_loading_hide = function(){
		$('#fake_loading').hide();
	};
	var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

	$('#fr_buy_point').on('submit',function(){
		window.funLazyLoad.start();
        window.funLazyLoad.show();
        $('#ip_usd').css({'border':'1px solid rgb(204, 204, 204)'});
        $('#password_transaction').css({'border':'1px solid rgb(204, 204, 204)'});
        $('.error_submit').hide();
		$(this).ajaxSubmit({
            type : 'POST',
            beforeSubmit : function(arr, $form, options) {
               if ($('#ip_usd').val() == "" || $('#ip_usd').val() < 0 || isNaN(parseFloat($('#ip_usd').val())) || $('#ip_usd').val() == "" ){
					$('.point_error').show();
					$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').attr('placeholder','Please enter USD number');
					window.funLazyLoad.reset();
					return false;
				}
				if ($('#password_transaction').val() == "")
				{
					$('#password_transaction').css({'border':'1px solid red'});
					$('#password_transaction').focus();
					$('#password_transaction').attr('placeholder','Please enter password transaction');
		        	window.funLazyLoad.reset();
					return false;
				}
            },
            success : function(result){
                result = $.parseJSON(result);

                if (result.count_share)
                {
                	$('#sucess_point_submit').hide();
                	$('.error_submit').html('Command not completed');
                	$('.error_submit').show();
	        		$('#ip_usd').val('');
					$('#password_transaction').val('');
					
					window.funLazyLoad.reset();
					return false;
                }

                if (result.percent)
                {
                	$('#sucess_point_submit').hide();
                	$('.error_submit').html('You only withdraw up to '+result.percent+' USD');
                	$('.error_submit').show();
	        		$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','You only withdraw up to '+result.percent+' USD');
					$('#password_transaction').val('');
					
					window.funLazyLoad.reset();
					return false;
                }
                

                if (result.password == -1)
	        	{
	        		$('#sucess_point_submit').hide();
	        		$('#password_transaction').css({'border':'1px solid red'});
					$('#password_transaction').focus();
					$('#password_transaction').val('');
					$('#password_transaction').attr('placeholder','Wrong password transaction');
					window.funLazyLoad.reset();
					return false;

	        	}
                if (result.complete == 1){
                    alertify.set('notifier','delay', 3000);
	                alertify.set('notifier','position', 'top-right');
	                window.funLazyLoad.reset();
	                alertify.success('Sell success !!!');
	                setTimeout(function(){ location.reload(true); }, 1000);
                    
                }
                if (result.money_transfer == 1)
	        	{
	        		$('#sucess_point_submit').hide();
	        		$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','You do not have enough USD');
					window.funLazyLoad.reset();
					return false;

	        	} 
            }
        });
        return false;
		
		
	});

});

String.prototype.reverse = function () {
        return this.split("").reverse().join("");
    }
function reformatText(input) {    
    var x = input.value;
    x = x.replace(/,/g, ""); // Strip out all commas
    x = x.reverse();
    x = x.replace(/.../g, function (e) {
        return e + ",";
    }); // Insert new commas
    x = x.reverse();
    x = x.replace(/^,/, ""); // Remove leading comma
    input.value = x;
}
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function checkPayment(invoid_id) {
	$.ajax({
		 type: "GET",
		 url: 'getreceivedbyaddress.html',
		 data: {
		     'invoid_id': invoid_id
		 },
		 success: function(result) {
		     result = JSON.parse(result);
		    
		     if (result.complete == -1) {

		         setTimeout(function(){ checkPayment(invoid_id); }, 5000);
		       
		     } 
		     else 
		     {
		         $('.coin_yes').show();
		         $('.coin_no').hide();
		         $('#message_no').html('This invoice has been paid!');
		     }
		 }
	});
}