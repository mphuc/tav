<?php 
   $self -> document -> setTitle("Cài đặt"); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-w">
   <div class="content-page">
      <div class="section-heading">
         <div class="col-xs-12">
            <h1 class="title text-uppercase">
               Cài đặt
            </h1>
         </div>
      </div>
   
                  <div class="col-md-3 med-12">
                     <div class="card-box text-center profile-card">
                        <div class="" style="position: relative;">
                           <form id="updateimg_profile" action="<?php echo $self -> url -> link('account/setting/updateprofile', '', 'SSL'); ?>" method="POST" novalidate="novalidate" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
                              <input type="file" id="file" name="avatar" style="position: absolute; width: 100%;
                                 height: 200px; opacity: 0;left: 0;top: 0">
                              <img style="display: none;" id="blah" style="margin-top: 15px; width: 100%; height: 220px" id="thumb_image" class="img-responsive center-block" src=""> 
                              <img class="img-responsive center-block" id="old_img" style="margin-top: 15px; width: 100%; height: 220px" src="<?php echo ($customer['img_profile'] == "") ?
                                 HTTPS_SERVER ."catalog/view/theme/default/images/notFound.png" : $customer['img_profile'] ?>" />
                              <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                                 <i class="fa fa-fw fa-times"></i>Vui lòng chọn hình ảnh với: 'jpeg', 'jpg', 'png', 'gif', 'bmp'
                              </div>
                              <button style="margin-top: 10px; display: none;" type="submit" class="btn btn-rounded btn-success btn-xs button_update_img_profile">Cập nhập</button>
                           </form>
                        </div>
                        <h3><?php echo $customer['firstname'] ?></h3>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="card-box">
                        <div class="card-box-head  border-b m-t-0">
                           <!--  <h4 class="header-title"><b>Profile Settings</b></h4> -->
                           <div class="clearfix" style="margin-top: 20px;"></div>
                           <div class="stepwizard col-md-12">
                              <div class="stepwizard-row setup-panel">
                                 <div class="stepwizard-step">
                                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                    <p>Thông tin tài khoản</p>
                                 </div>
                                 <div class="stepwizard-step">
                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" >2</a>
                                    <p>Thay đổi mật khẩu</p>
                                 </div>
                              </div>
                           </div>
                           <div class="row setup-content clearfix" id="step-1" style="clear: both;">
                              <div class="col-xs-12">
                                 <div class="col-md-12">
                                    <h3 class="text-center">Thông tin tài khoản</h3>
                                    <!-- step 1 -->
                                    <div id="EditProfile" data-link="<?php echo $self -> url -> link('account/setting/account', '', 'SSL'); ?>" data-id="<?php echo $self->session -> data['customer_id'] ?>" >
                                       <form id="updateProfile" action="<?php echo $self -> url -> link('account/setting/update_profile', '', 'SSL'); ?>" method="POST" novalidate="novalidate" class="form-horizontal group-border-dashed">
                                          <div class="form-group">
                                             <label class="col-md-3">UserName</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input class="form-control valid" id="UserName" name='username'  type="text" readonly='true' data-link="<?php echo $self -> url -> link('account/register/checkuser', '', 'SSL'); ?>" value="<?php echo $customer['username'] ?>" />
                                                   <span id="UserName-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="form-group">
                                             <label class="col-md-3">Email</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input class="form-control" data-link="<?php echo $self -> url -> link('account/register/checkemail', '', 'SSL'); ?>" id="Email" name="email" type="text" value="<?php echo $customer['email'] ?>"/>
                                                   <span id="Email-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-3">Số điện thoại</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input placeholder="<?php echo $lang['text_phone'] ?>" data-link="<?php echo $self -> url -> link('account/register/checkphone', '', 'SSL'); ?>" class="form-control" id="Phone" name="telephone" type="text" value="<?php echo $customer['telephone'] ?>"/>
                                                   <span id="Phone-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          
                                         
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row setup-content clearfix" id="step-3" style="clear: both;">
                              <div class="col-xs-12">
                                 <div class="col-md-12">
                                    <h3 class="text-center">Thay đổi mật khẩu</h3>
                                    <!-- step 3 -->
                                    <div class="col-md-12">
                                      
                                       <form id="frmChangePassword" action="<?php echo $self -> url -> link('account/setting/editpasswd', '', 'SSL'); ?>" class="form-horizontal" method="post" novalidate="novalidate">
                                          <div class="form-group">
                                             <label class="col-md-3 ">Mật khẩu cũ</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input placeholder="Mật khẩu cũ" class="form-control" id="OldPassword" type="password" data-link="<?php echo $self -> url -> link('account/setting/checkpasswd', '', 'SSL'); ?>" />
                                                   <div class="clearfix"></div>
                                                   <span id="OldPassword-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-3 ">Mật khẩu mới</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input placeholder="Mật khẩu mới" class="form-control" id="Password" name="password" type="password"/>
                                                   <span id="Password-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-3 ">Nhập lại mật khẩu mới</label>
                                             <div class="col-md-9">
                                                <div class="input-group">
                                                   <input placeholder="Nhập lại mật khẩu mới" class="form-control" id="ConfirmPassword"  type="password"/>
                                                   <span id="ConfirmPassword-error" class="field-validation-error">
                                                   <span></span>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label class="col-md-3 "></label>
                                             <div class="col-md-9">
                                                <button type="submit" class="btn btn-primary password-submit">Thay đổi mật khẩu</button>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                
                                 </div>
                              </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  
               
   <!-- End Row -->
   <!-- End row -->
</div>
<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Update profile successfull !!!');
   }
   
</script>
<?php echo $self->load->controller('common/footer') ?>