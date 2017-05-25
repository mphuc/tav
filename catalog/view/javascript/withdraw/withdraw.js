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

    $('#payment_method').on('change',function(){
    	var url = $(this).val();
    	window.location.href = 'withdraw.html?type='+url;

    });

	$('#ip_usd').on('input propertychange',function(){
		$('#ip_usd').css({'border':'1px solid #ccc'});
		delay(function(){
			$.ajax({
	            url : "index.php?route=account/deposit/get_btc",
	            type : "post",
	            dateType:"text",
	            data : {
	                'ip_usd' : $('#ip_usd').val()
	            },
	            success : function (result){
	                $('#ip_btc').val(result);
	            }
	        });
		}, 1000 );
	});

	$('#fr_buy_point').on('submit',function(){
		window.funLazyLoad.start();
        window.funLazyLoad.show();
		$(this).ajaxSubmit({
            type : 'POST',
            beforeSubmit : function(arr, $form, options) {
               if ($('#wallet_addres').val() == "")
				{
					$('#wallet_addres').css({'border':'1px solid red'});
					$('#wallet_addres').focus();
					$('#wallet_addres').attr('placeholder','Please update your information');
		        	window.funLazyLoad.reset();
					return false;
				}

               if ($('#ip_usd').val() == "" || $('#ip_usd').val() < 20 || isNaN(parseFloat($('#ip_usd').val())) || $('#ip_usd').val() == "" || $('#ip_btc').val() == "Loading..." ){
					$('.point_error').show();
					$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Please enter USD min 20 USD');
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
				$('#sucess_point_submit').html('<img  style="width:100px; margin-top:30px;" src="catalog/view/theme/default/images/loading-gallery.gif" />');
            },
            success : function(result){
                result = $.parseJSON(result);
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
	        	if (result.maxfive)
	        	{
	        		$('#sucess_point_submit').hide();
	        		$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Maximum withdrawal '+result.maxfive+' USD');
					window.funLazyLoad.reset();
					return false;
	        	}

	        	if (result.pedding)
	        	{
	        		$('#sucess_point_submit').hide();
	        		
					$('#ip_usd').val('');
					$('#password_transaction').val('');
					$('.pendding_withdraw').show();
					window.funLazyLoad.reset();
					return false;
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
                if (result.complete == 1){
                    alertify.set('notifier','delay', 3000);
	                alertify.set('notifier','position', 'top-right');
	                window.funLazyLoad.reset();
	                alertify.success('Withdraw success !!!');
	                setTimeout(function(){ location.reload(true); }, 1000);
                    
                }
            }
        });
        return false;
	});


	$('#fr_buy_point_perfect').on('submit',function(){
		window.funLazyLoad.start();
        window.funLazyLoad.show();
		$(this).ajaxSubmit({
            type : 'POST',
            beforeSubmit : function(arr, $form, options) {

            	if ($('#wallet_addres').val() == "")
				{
					$('#wallet_addres').css({'border':'1px solid red'});
					$('#wallet_addres').focus();
					$('#wallet_addres').attr('placeholder','Please update your information');
		        	window.funLazyLoad.reset();
					return false;
				}

               if ($('#ip_usd').val() == "" || $('#ip_usd').val() < 20 || isNaN(parseFloat($('#ip_usd').val())) || $('#ip_usd').val() == ""  ){
					$('.point_error').show();
					$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Please enter USD min 20 USD');
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
				$('#sucess_point_submit').html('<img  style="width:100px; margin-top:30px;" src="catalog/view/theme/default/images/loading-gallery.gif" />');
            },
            success : function(result){
                result = $.parseJSON(result);
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
	        	if (result.maxfive)
	        	{
	        		$('#sucess_point_submit').hide();
	        		$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Maximum withdrawal '+result.maxfive+' USD');
					window.funLazyLoad.reset();
					return false;
	        	}
	        	if (result.pedding)
	        	{
	        		$('#sucess_point_submit').hide();
	        		
					$('#ip_usd').val('');
					$('#password_transaction').val('');
					$('.pendding_withdraw').show();
					window.funLazyLoad.reset();
					return false;
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
                if (result.complete == 1){
                    alertify.set('notifier','delay', 3000);
	                alertify.set('notifier','position', 'top-right');
	                window.funLazyLoad.reset();
	                alertify.success('Withdraw success !!!');
	                setTimeout(function(){ location.reload(true); }, 1000);
                    
                }
            }
        });
        return false;
	});


	$('#fr_buy_point_payeer').on('submit',function(){
		window.funLazyLoad.start();
        window.funLazyLoad.show();
		$(this).ajaxSubmit({
            type : 'POST',
            beforeSubmit : function(arr, $form, options) {
               	if ($('#wallet_addres').val() == "")
				{
					$('#wallet_addres').css({'border':'1px solid red'});
					$('#wallet_addres').focus();
					$('#wallet_addres').attr('placeholder','Please update your information');
		        	window.funLazyLoad.reset();
					return false;
				}

               	if ($('#ip_usd').val() == "" || $('#ip_usd').val() < 20 || isNaN(parseFloat($('#ip_usd').val())) || $('#ip_usd').val() == ""  ){
					$('.point_error').show();
					$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Please enter USD min 20 USD');
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
				$('#sucess_point_submit').html('<img  style="width:100px; margin-top:30px;" src="catalog/view/theme/default/images/loading-gallery.gif" />');
            },
            success : function(result){
                result = $.parseJSON(result);
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
	        	if (result.maxfive)
	        	{
	        		$('#sucess_point_submit').hide();
	        		$('#ip_usd').css({'border':'1px solid red'});
					$('#ip_usd').focus();
					$('#ip_usd').val('');
					$('#ip_usd').attr('placeholder','Maximum withdrawal '+result.maxfive+' USD');
					window.funLazyLoad.reset();
					return false;
	        	}
	        	if (result.pedding)
	        	{
	        		$('#sucess_point_submit').hide();
	        		
					$('#ip_usd').val('');
					$('#password_transaction').val('');
					$('.pendding_withdraw').show();
					window.funLazyLoad.reset();
					return false;
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
                if (result.complete == 1){
                    alertify.set('notifier','delay', 3000);
	                alertify.set('notifier','position', 'top-right');
	                window.funLazyLoad.reset();
	                alertify.success('Withdraw success !!!');
	                setTimeout(function(){ location.reload(true); }, 1000);
                    
                }
            }
        });
        return false;
	});
});
function show_payment(id){
	$('html, body').animate({
        scrollTop: $("#sucess_point_submit").offset().top
    }, 400);
	$('#sucess_point_submit').show();
	$('#sucess_point_submit').html('<img  style="width:100px; margin-top:30px;" src="catalog/view/theme/default/images/loading-gallery.gif" />');
	
	$.ajax({
        url : "index.php?route=account/deposit/get_invoid",
        type : "post",
        dateType:"text",
        data : {
            'invoice_id' : id
        },
        success : function (result){

            result = JSON.parse(result);
	    	var html='<div class="col-md-12 text-center"><img style="margin-left:-10px" src="https://chart.googleapis.com/chart?chs=225x225&chld=L|0&cht=qr&chl=bitcoin:'+result.my_address+'?amount='+result.ip_btc+'"/></div>';
        	html +='<p>Please send '+result.ip_btc+' BTC to wallets <br/> '+result.my_address+' <br/> to buy '+numberWithCommas(result.ip_usd)+' USD</p>';
        	
        	$('#sucess_point_submit').html(html);
        	check_payment(id);
        	$('#ip_usd').val('');
        	$('#ip_btc').val('');
        	$('#password_transaction').val('');
        }
    });
}

function check_payment(id){
	$.ajax({
        url : "index.php?route=account/deposit/check_payment",
        type : "post",
        dateType:"text",
        data : {
            'invoice_id' : id
        },
        success : function (result){
            result = JSON.parse(result);
	    	if (result.status == 0)
	    	{
	    		setTimeout(function(){ check_payment(id); }, 5000);
	    	}
	    	if (result.status == 3)
	    	{
	    		alertify.set('notifier','delay', 3000);
                alertify.set('notifier','position', 'top-right');
                alertify.success('Payment success !!!');
                setTimeout(function(){ location.reload(true); }, 1000);

	    	}
        }
    });
}

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
