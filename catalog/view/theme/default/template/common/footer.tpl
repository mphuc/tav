</div>
     </div>
<!-- 
<script src="catalog/view/theme/default/assets/bower_components/jquery/dist/jquery.min.js"></script>  -->
 <script src="catalog/view/theme/default/assets/bower_components/moment/moment.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/chart.js/dist/Chart.min.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/ckeditor/ckeditor.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/bootstrap-validator/dist/validator.min.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/dropzone/dist/dropzone.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/editable-table/mindmup-editabletable.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/datatables/media/js/dataTables.bootstrap4.min.js"></script>
 <script src="catalog/view/theme/default/assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
 <script src="catalog/view/theme/default/assets/js/main.js"></script>
 <script type="text/javascript">
 	$('.has-sub-menu').on('click',function(){
 		$(this).toggleClass('active');
 		//return false;
 	});
 </script>

</body>
</html>
    <script type="text/javascript">

var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});
        </script>

   <script type="text/javascript">
   
   	$('.packet-invest').on('submit', function(){

   		if ( $(this).children('.form_code').val() == "")
   		{
   			$(this).children('.form_code').css({'border':'1px solid red'});
   			$(this).children('.form_code').attr('placeholder','Vui lòng nhập mã Code');
   			return false;
   		}

   		var self = $(this);
   		alertify.confirm('<p class="text-center" style="font-size:25px;color: black;text-transform: uppercase;height: 40px">Bạn có muốn tham gia gói  '+$(this).children('input').val()+' VNĐ không ? ?</p>',
		  function(){
		    window.funLazyLoad.start();
	   		setTimeout(function(){
				self.ajaxSubmit({
					success : function(result) {
						result = $.parseJSON(result);
						if (result.no_money == 1)
						{
							window.funLazyLoad.reset();
							xhtml = '<div class="col-md-12"><h2 class="text-center">Code bạn nhập không đúng<p></div>';
							alertify.alert(xhtml, function(){
							 
							  });	
						}
						else
						{
							window.funLazyLoad.reset();
							xhtml = '<div class="col-md-12"><h3 class="text-center">Kích hoạt gói thành công. Cám ơn bạn đã sử dụng dịch vụ</h3></div>';
							alertify.alert(xhtml, function(){
							    window.funLazyLoad.reset();
								    location.reload(true);
							  });
						}
						
						
					}
				});
				
			}, 200);
		  },
		  function(){
		});
   		return false;
   	});


   	$('.packet-invest-upgray').on('submit', function(){

   		if ( $(this).children('.form_code').val() == "")
   		{
   			$(this).children('.form_code').css({'border':'1px solid red'});
   			$(this).children('.form_code').attr('placeholder','Vui lòng nhập mã Code');
   			return false;
   		}

   		var self = $(this);
   		alertify.confirm('<p class="text-center" style="font-size:25px;color: black;text-transform: uppercase;height: 40px">Bạn có muốn gia hạn gói không ? ?</p>',
		  function(){
		    window.funLazyLoad.start();
	   		setTimeout(function(){
				self.ajaxSubmit({
					success : function(result) {
						result = $.parseJSON(result);
						if (result.no_money == 1)
						{
							window.funLazyLoad.reset();
							xhtml = '<div class="col-md-12"><h2 class="text-center">Code bạn nhập không đúng<p></div>';
							alertify.alert(xhtml, function(){
							 
							  });	
						}
						else
						{
							window.funLazyLoad.reset();
							xhtml = '<div class="col-md-12"><h3 class="text-center">Gia hạn gói thành công. Cám ơn bạn đã sử dụng dịch vụ</h3></div>';
							alertify.alert(xhtml, function(){
							    window.funLazyLoad.reset();
								    location.reload(true);
							  });
						}
						
						
					}
				});
				
			}, 200);
		  },
		  function(){
		});
   		return false;
   	});
   	
	 /*function check_payment(){
	 	$.ajax({
	        url : "<?php echo $check_payment ?>",
	        type : "post",
	        dataType:"text",
	        data : {
	           
	        },
	        success : function (result){
	        	result = $.parseJSON(result);
	            if (result.confirmations == "3"){
	            	$('.ajs-btn.ajs-ok').trigger('click');
	            	var xhtml = '<div style="font-size:25px;color: black;text-transform: uppercase;height: 20px" class="col-md-12 text-center"><h3>You have successfully activate!</h3></div>';
	            	alertify.alert(xhtml, function(){
					    location.reload(true);
					  });
	            }
	            if (result.confirmations == "0")
	            {
	            	setTimeout(function(){ check_payment(); }, 1500);
	            }

	        }
	    });
	 }*/
   </script>
  
   