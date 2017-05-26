<!DOCTYPE html>
<html>
   <!-- Mirrored from light.pinsupreme.com/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 May 2017 06:01:50 GMT -->
   <head>
      <title>Quên mật khẩu - Tâm An Việt</title>
      <meta charset="utf-8">
      <meta content="ie=edge" http-equiv="x-ua-compatible">
      <meta content="template language" name="keywords">
      <meta content="Tamerlan Soziev" name="author">
      <meta content="Admin dashboard html template" name="description">
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <link href="catalog/view/theme/default/images/logo.png" rel="shortcut icon">
      <link href="catalog/view/theme/default/assets/apple-touch-icon.png" rel="apple-touch-icon">
      <link href="catalog/view/theme/default/assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
      <link href="../fast.fonts.net/cssapi/175a63a1-3f26-476a-ab32-4e21cbdb8be2.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/css/main.css" rel="stylesheet">
      <script src="https://www.google.com/recaptcha/api.js?hl=en"></script>
   </head>
   <body class="auth-wrapper">
      <div class="all-wrapper with-pattern">
         <div class="auth-box-w">
            <div class="logo-w" style="padding: 2%"><a href="index.html"><img alt="" src="catalog/view/theme/default/images/logo.png" style="width: 200px;"></a></div>
            <h4 class="auth-header">Quên mật khẩu</h4>
            <form action="forgot.html" method="post">
               <div class="form-group">
                  <label for="">Tên đăng nhập</label>
                  
                  <input class="form-control" name="email" placeholder="Nhập tên đăng nhập" type="text">
                  <div class="pre-icon os-icon os-icon-user-male-circle"></div>
               </div>
               
               <div class="form-group">
                  <div  class="g-recaptcha" data-sitekey="6Lcm_iIUAAAAAJGRhY09TEmAX01wTF3_8mkZRJQF"></div>

               </div>
               <div class="buttons-w">
                  <button class="btn btn-primary">Quên mật khẩu</button>
                  <div class="form-check-inline"><label class="form-check-label"><a class="btn" href="<?php echo $back; ?>.html">GO BACK</a></div>
               </div>
               <br>
               <div class="form-group">
                  <?php if ($error_warning) { ?>
                   <div class="text-warning"><i class="fa fa-exclamation-circle"></i>
                      <?php echo $error_warning; ?>
                   </div>
                   <?php } ?>
               </div>
            </form>
         </div>
      </div>
   </body>
<script src="catalog/view/theme/default/assets/js/jquery.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/bootstrap.min.js"></script> 

<script src="catalog/view/javascript/alertifyjs/alertify.js" type="text/javascript"></script>
<link href="catalog/view/theme/default/css/al_css/alertify.css" rel="stylesheet">
</html>

<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create user successfull !!!');
   }
   jQuery(document).ready(function($) {
      jQuery('.cap_code_new').click(function(){
         jQuery('.img_capcha').attr({'src':'<?php echo HTTPS_SERVER;?>captcha_code.php'});

      });
   });
</script>