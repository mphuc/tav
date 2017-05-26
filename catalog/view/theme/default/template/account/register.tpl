<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="author" content="Mackayshieldslife">


<title>Tạo tài khoản - Tâm An Viêt</title>

<!-- FAVICON -->
<link rel="icon" href="catalog/view/theme/default/images/logo_icon.png">


<link rel="stylesheet" href="catalog/view/theme/default/assets/plugins/morris/morris.css">
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/core.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/components.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/icons.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/pages.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/responsive.css" type="text/css" />
<link href="catalog/view/theme/default/css/customer.css" rel="stylesheet">
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>

<script src="catalog/view/javascript/register/register.js" type="text/javascript"></script>
<script src="catalog/view/theme/default/assets/js/modernizr.min.js"></script>

</head>

<body class="loreg-page close-it customer">
<div id="logreg-wrapper" class="login-style2 text-center customer"> 
   <div class="container">
     
     <form id="register-account" action="<?php echo $self -> url -> link('account/registers/confirmSubmit', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate">
         <a href="#" ><img style="margin-bottom: 20px;width: 300px" src="catalog/view/theme/default/images/logo.png" class="img-responsive center-block" alt=""/></a>
           
            <div class="form-group">
               <div class="textbox-login">
                  <label>Tên đăng nhập</label>
                  <input type="hidden" name="node" value="<?php echo $self->request->get['ref']; ?>">
                  <input class="form-control" placeholder="Tên đăng nhập" name="username" id="username" value="" data-link="<?php echo $actionCheckUser; ?>">
                 
               </div>
            </div>

            
            <div class="form-group">
                  <div class="textbox-login">
                  <label>Địa chỉ email</label>
                  <input class="form-control" placeholder="Địa chỉ email" name="email" id="email" data-link="<?php echo $actionCheckEmail; ?>">
                  
               </div>
            </div>

             <div class="form-group">
                  <div class="textbox-login">
                  <label>Số điện thoại</label>
                  <input class="form-control" placeholder="Số điện thoại" name="telephone" id="phone" data-link="<?php echo $actionCheckPhone; ?>">
                  
               </div>
            </div>
            <div class="form-group">
                  <div class="textbox-login">
                  <label>Người bảo trợ</label>
                  <input class="form-control" placeholder="Người bảo trợ" name="sponser" id="" readonly value="<?php echo $customercode['username'];?>">
                  
               </div>
              
            </div>
            
            

           <div class="form-group">
                  <div class="textbox-login">
                  <label>Mật khẩu</label>
                  <input class="form-control" placeholder="Mật khẩu" id="password" name="password" type="password">
                 
               </div>
            </div>

              
            <div class="clearfix"></div>   
            <div class="bottom-login">
               <div class="remember-text-login text-left">
                  <span class="checkbox-custom checkbox-primary">
                  <input id="agreeTerm" type="checkbox" value="true" style="width: 20px; float: left;padding: 0px;margin-top: -14px; margin-right: 10px;">
                  <label for="requiredCheckbox" class="text-left">I agree to the <a href="javascript:void(0)">Terms and Conditions</a></label>
                  </span>
               </div>
            </div>
            <div class="bottom-login" style="margin-top: 30px;">
              <button disabled="true" style="margin: 0 auto" type="submit" class="btn btn-info mobile-btn-login btn-sign waves-effect waves-dark">Register</button>
            </div>
            
            </div>
      </form>
      
   </div>
</div>
<!-- END wrapper --> 

<!-- Page Loader --> 
<div class="page-loader">
   <a href="#"><img style="width: 350px;" src="catalog/view/theme/default/images/logo.png" class="img-responsive center-block" alt=""/></a>
   <span class="text-uppercase">Loading...</span>
</div>

<!-- SmartBox Js files --> 
<script>
       var resizefunc = [];
</script> 
<script src="catalog/view/theme/default/assets/js/bootstrap.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/pace.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/loader.js"></script> 
<script src="catalog/view/theme/default/assets/js/detect.js"></script> 
<script src="catalog/view/theme/default/assets/js/fastclick.js"></script> 
<script src="catalog/view/theme/default/assets/js/waves.js"></script> 
<script src="catalog/view/theme/default/assets/js/wow.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.slimscroll.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.nicescroll.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.scrollTo.min.js"></script> 
<script src="catalog/view/theme/default/assets/pages/jquery.todo.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/moment/moment.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/morris/morris.min.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/raphael/raphael-min.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script> 
<script src="catalog/view/theme/default/assets/pages/jquery.charts-sparkline.js"></script> 
<script type="text/javascript" src="../../../www.gstatic.com/charts/loader.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.app.js"></script> 
<script src="catalog/view/theme/default/assets/js/cb-chart.js"></script> 

</body>

<!-- Mirrored from ckthemes.com/html/smartbox/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Apr 2017 09:12:38 GMT -->
</html>
<?php die;
$self -> document -> setTitle('Register User');
 echo $header; ?>
 <style type="text/css" media="screen">
    .main-header{
      display: none;
    }
 </style>
 
<div class="login-form page-login-image">
   <div class="main-login-form register-page">
         <div class="content-login">
            <div class="login-page">
               <div class="logo-title">
                  <!-- Template Logo -->
                  <img src="catalog/view/theme/default/img/logo.png" alt="logo" style=" width:150px;">
               </div>
               <p class="sign-login">Create an Account.</p>
               <!-- Start Register Form -->
               
               
               <!-- End Register Form -->
              
            </div>
         </div>
      </div>
</div>

<style type="text/css">
   footer, .header-logo{display: none !important;}
   .container{padding-top: 10px;}
</style>
<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create user successfull !!!');
   }
   
</script>
<?php echo $footer; ?>