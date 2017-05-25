<?php 
   $self -> document -> setTitle('Trực tiếp F1'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-w">
<div class="content-page">
    
        <div class="section-heading">
       <div class="col-xs-12">
          <h1 class="title text-uppercase">
            Trực tiếp F1
          </h1>
       </div>
       
    </div>
  
</div>
<div class="content-page">
    <div class="content">
       
        <div class="cb-page-content">
            <div class="container">
                <div class="row">
     
    </div>
    <?php if (count($refferals_pnode) > 0) { ?>
       <div class="">
            <div class="card-box">
                <div class="card-box-head  border-b m-t-0">
                    <h4 class="header-title"><b>My Introducer Detail</b></h4>
                    <div id="no-more-tabless" class="table-responsive" style="margin-top: 30px;">
                     
                        <table class="table table-condensed table-striped table-hover table-bordered" id="data-table">
                        <thead>
                           <tr>
                              <th class="text-center">Thứ tự</th>
                              <th>Tên đăng nhập</th>
                              <th>Số điện thoại</th>
                              <th>Email</th>
                              <th>Ngày đăng ký</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $count = 1; foreach ($refferals_pnode as $key => $value) { ?>
                           <tr>
                              <td data-title="#" align="center"><?php echo $count ?></td>
                              <td data-title="Tên đăng nhập"><?php echo $value['username'] ?></td>
                            
                              <td data-title="Số điện thoại" >
                                 <?php echo $value['telephone']; ?>
                              </td>
                              <td data-title="Email"><?php echo $value['email'] ?></td>
                              
                             <td data-title="Ngày đăng ký"><?php echo date("d/m/Y H:i A", strtotime($value['date_added'])); ?></td>
                           </tr>
                           <?php $count++; } ?>
                        </tbody>
                     </table>

                  </div>
                </div>
                
            </div>
        </div>
      <?php } ?>
            <div class="row">
      <div class="col-md-12">
        <div class="">
        <div class="card-box">
                <div class="card-box-head  border-b m-t-0">
                    <h4 class="header-title"><b>  </b></h4>
                    
                  <div id="no-more-tabless" class="table-responsive">
                  <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-hover table-bordered" id="data-table">
                     
                        <thead>
                           <tr>
                              <th class="text-center">Thứ tự</th>
                              <th>Tên đăng nhập</th>
                              <th>Số điện thoại</th>
                              <th>Email</th>
                              <th>Ngày đăng ký</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php if (count($refferals) > 0) { ?>
                           <?php $count = 1; foreach ($refferals as $key => $value) { ?>
                           <tr>
                              <td data-title="Thứ tự" align="center"><?php echo $count ?></td>
                              <td data-title="Tên đăng nhập"><?php echo $value['username'] ?></td>
                              
                              <td data-title="Số điện thoại" >
                                 <?php echo $value['telephone']; ?>
                              </td>
                              <td data-title="Email"><?php echo $value['email'] ?></td>
                              
                             <td data-title="Ngày đăng ký"><?php echo date("d/m/Y H:i A", strtotime($value['date_added'])); ?></td> 
                           </tr>

                           <?php $count++; } ?>
                           <?php } else { ?>
                            <tr>
                              <td colspan="5"> No Data</td>
                            </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                     <div class="clearfix"></div>
                      <div class="text-center">
                        <?php echo $pagination; ?>
                      </div>
                  </div>
               </div>
            </div>
      </div>
   </div>
</div>
<?php echo $self->load->controller('common/footer') ?>