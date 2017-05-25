<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Mackayshieldslife.">
<meta name="author" content="Mackayshieldslife">


<title>Create New User | Mackayshieldslife.com </title>

<!-- FAVICON -->
<link rel="icon" href="catalog/view/theme/default/images/logo_icon.png">

<link href="favicon.png" rel="shortcut icon">
<link href="apple-touch-icon.png" rel="apple-touch-icon">
<link href="catalog/view/theme/default/assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">

<link href="catalog/view/theme/default/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="catalog/view/theme/default/assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
<link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="catalog/view/theme/default/assets/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="catalog/view/theme/default/assets/css/main.css" rel="stylesheet">


<link href="catalog/view/theme/default/css/customer.css" rel="stylesheet">
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>

<script src="catalog/view/javascript/register/register.js" type="text/javascript"></script>
<script src="catalog/view/theme/default/assets/js/modernizr.min.js"></script>

</head>

<body>
   <div class="all-wrapper with-pattern register_account">
         <div class="auth-box-w wider col-md-8">
            <div class="logo-w"><a href="index.html"> <a href="#" ><img style="margin-bottom: 20px;width: 240px" src="catalog/view/theme/default/images/logo.png" class="img-responsive center-block" alt=""/></a></a></div>
            <h4 class="auth-header">Tạo tài khoản</h4>
            <?php if(!$p_binary) { ?>
            <form id="register-account" action="<?php echo $self -> url -> link('account/register', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate">
               <?php  } else { ?>
            
            <form id="register-account" action="<?php echo $self -> url -> link('account/personal/register_submit', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate" style="margin-bottom: 70px;" >
               <?php }?>
               <?php if($p_binary) { ?>
               <input type="hidden" name="p_binary" value="<?php echo $p_binary ?>"/>
               <input type="hidden" name="postion" value="<?php echo $postion ?>">
               <?php } ?>
               <?php 
            $token = explode("_", $self -> request -> get['id']);
            if(intval($self -> checkBinaryLeft($token[0], $token[1])) === 1) { ?>
           <div class="col-md-6" style="float: left;">
            <div class="form-group">
               <div class="textbox-login">
                  <label>Tên đăng nhập</label>
                  <input type="hidden" name="node" value="<?php echo $token['2']; ?>">
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
                  <label>Mật khẩu</label>
                  <input class="form-control" placeholder="Mật khẩu" id="password" name="password" type="password">
                 
               </div>
            </div>
            <div class="form-group">
                  <div class="textbox-login">
                     <label>Người bảo trợ</label>
                     <input class="form-control" placeholder="Người bảo trợ" name="sponser" id="" readonly value="<?php echo $customercode['username'];?>">
                     
                  </div>
                  
            </div>

            
         </div>
         <div  class="col-md-6" style="float: left;">
            <div class="form-group">
                  <div class="textbox-login">
                  <label>Ngân hàng</label>
                  <select class="form-control" name="bank_name" id="bank_name">
                     <option value="Vietcombank">Vietcombank</option>
                     <option value="Agribank">Agribank</option>
                  </select>
                  
               </div>
            </div>

            <div class="form-group">
                  <div class="textbox-login">
                  <label>Tên tài khoản ngân hàng</label>
                  <input class="form-control" placeholder="Tên tài khoản ngân hàng" name="account_hodder" id="account_hodder" >
               </div>
            </div>

            <div class="form-group">
                  <div class="textbox-login">
                  <label>Số tài khoản ngân hàng</label>
                  <input class="form-control" placeholder="Số tài khoản ngân hàng" name="account_number" id="account_number" >
               </div>
            </div>

            <div class="form-group">
                  <div class="textbox-login">
                  <label>Chi nhánh ngân hàng</label>
                  <input class="form-control" placeholder="Chi nhánh ngân hàng" name="brank" id="brank" >
               </div>
            </div>

            <div class="form-group">
                  <div class="textbox-login">
                     <label>Vị trí</label>
                     <input class="form-control" placeholder="Vị trí" name="position" id="" value="<?php echo ($token['1'] == "left") ? "Bên trái" : "Bên phải" ?>" readonly>
                  </div>
                  
            </div>
            
         </div>
            <div class="clearfix"></div>   
            
            <div class="bottom-login text-center" style="margin-top: 30px;">
              <button style="margin: 0 auto" type="submit" class="btn btn-info mobile-btn-login btn-sign waves-effect waves-dark">Đăng ký tài khoản</button>
            </div>
            
            </div>
                  


            </form>
            <?php } else { ?>
         <div class="alert alert-danger text-center" style="margin-top:10px;">
            
            <strong>Cảnh báo!</strong>  Chi nhánh này đã có! Vui lòng chọn một chi nhánh!!

            <button onclick="goBack()" type="button" style="margin-top: 40px; width: 100%; float: left;" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i>  Trở về</button>
         </div>
         <?php } ?>
         <div class="clearfix"></div>

         </div>
      </div>


<?php echo $footer; ?>

<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Create user successfull !!!');
   }
   
</script>
