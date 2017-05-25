<?php $route=$self -> request -> get['route']; ?>
<div class="menu-w menu-activated-on-click">
   <div class="logo-w">
      <a class="logo" href="home.html">
        <img style="margin-bottom: 20px;width: 200px" src="catalog/view/theme/default/images/logo.png" class="img-responsive center-block" alt=""/>
      </a>
      <div class="mobile-menu-trigger">
         <div class="os-icon os-icon-hamburger-menu-1"></div>
      </div>
   </div>
   <div class="menu-and-user">
      <div class="logged-user-w">
         <div class="avatar-w"><img alt="" src="<?php if($customer['img_profile']) echo $customer['img_profile']; else echo "catalog/view/theme/default/images/logo.png"; ?>"></div>
         <div class="logged-user-info-w">
            <div class="logged-user-name"><?php print_r($customer['username']) ?></div>
            
         </div>
      </div>
      <ul class="main-menu">
         <li>
            <a href="home.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-window-content"></div>
               </div>
               <span>Trang quản lý</span>
            </a>
         </li>
         <li>
            <a href="refferal.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-donut-chart-2"></div>
               </div>
               <span>Trực tiếp F1</span>
            </a>
            
         </li>
         <li>
            <a href="investing.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-wallet-loaded"></div>
               </div>
               <span>Gói đầu tư</span>
            </a>
            
         </li>
         <li>
            <a href="genealogy.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-delivery-box-2"></div>
               </div>
               <span>Cây hệ thống</span>
            </a>
         </li>
         <li class="has-sub-menu">
            <a href="#" onclick="return false">
               <div class="icon-w">
                  <div class="os-icon os-icon-user-male-circle"></div>
               </div>
               <span>Lịch sử giao dịch</span>
            </a>
            <ul class="sub-menu">
               <li><a href="direct-profit.html">Hoa hồng trực tiếp</a></li>
               <li><a href="network-profit.html">Hoa hồng đội nhóm</a></li>
            </ul>
         </li>
         <li>
            <a href="your-profile.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-wallet-loaded"></div>
               </div>
               <span>Cài đặt</span>
            </a>
            
         </li>
         
         <li>
            <a href="logout.html">
               <div class="icon-w">
                  <div class="os-icon os-icon-newspaper"></div>
               </div>
               <span>Đăng xuất</span>
            </a>
         </li>
      </ul>
   </div>
</div>


<?php /* ?>

<div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <!--- Divider -->
            <div class="col-md-12 user_left_colum text-left">
                <img src="<?php echo ($customer['img_profile'] == "") ?
                      HTTPS_SERVER ."catalog/view/theme/default/images/notFound.png" : $customer['img_profile'] ?>"">
                <div style="margin-top: 5px;"><?php echo $customer['firstname'] ?></div>

                <div><?php echo $customer['username'] ?></div>
                <div class="clearfix"></div>
                
            </div>

            <div class="clearfix" ></div>
            <div id="sidebar-menu" style="margin-top: 10px;">
                <ul>
                    
                    <li class="has_sub">
                        <a href="home.html" class="waves-effect"> <i class="fa fa-dashboard"></i> <span> Dashboard </span> </a>  
                    </li>
                    <li class="has_sub">
                        <a href="deposit.html" class="waves-effect"> <i class="fa fa-cloud-download"></i> <span>Deposit History</span> </a>  
                    </li>
                    <li class="has_sub">
                        <a href="transfer.html" class="waves-effect"> <i class="fa fa-recycle"></i> <span>Transfer</span> </a>  
                    </li>
                    <li class="has_sub">
                        <a href="withdraw.html" class="waves-effect"> <i class="fa fa-cloud-upload"></i> <span>Withdrawal History</span> </a>  
                    </li>
                    <li  class="has_sub"> <a href="investing.html" class="waves-effect"> <i class="fa fa-cubes"></i> <span> Investing </span> </a> </li>

                    <li  class="has_sub"> <a href="refferal.html" class="waves-effect"> <i class="fa fa-group"></i> <span>My Referral </span> </a> </li>
                    <li  class="has_sub"> <a href="genealogy.html" class="waves-effect"> <i class="fa fa-sitemap"></i> <span> Genealogy </span> </a> </li>

                    <li  class="has_sub"> <a href="letter.html" class="waves-effect"> <i class="fa fa-envelope"></i> <span> Welcome Letter </span> </a> </li>

                    <li  class="has_sub"> <a href="stock.html" class="waves-effect"> <i class="fa fa-database"></i> <span> Stock </span> </a> </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"> <i class="fa fa-history"></i> <span> Profit History </span> <span class="fa fa-angle-right cb-nav-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="week-profit.html">Weekly profit</a> </li>
                            <li><a href="network-profit.html">Network Commision</a> </li>
                            <li><a href="direct-profit.html">Direct commission</a> </li>
                            <li><a href="resonance-profit.html">Resonance Commision</a> </li>
                        </ul>
                    </li>
                    <li  class="has_sub"> <a href="your-profile.html" class="waves-effect"> <i class="fa fa-cogs"></i> <span> Account Settings</span> </a> </li>
                    <li  class="has_sub"> <a href="logout.html" class="waves-effect"> <i class="fa fa-power-off"></i> <span> Logout</span> </a> </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            
        </div>
    </div>
    <!-- Left Sidebar End --> 
*/ ?>