<?php $self->document->setTitle(" Trang quản lý "); echo $self->load->controller('common/header'); echo $self->load->controller('common/column_left'); ?>
<div class="content-w">
  <div class="content-page">
      
          <div class="section-heading">
         <div class="col-xs-12">
            <h1 class="title text-uppercase">
              TRANG QUẢN LÝ
            </h1>
         </div>
         
      </div>
  </div>
    <div class="content-w">
               
               <div class="content-i">
                  <div class="content-box">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="element-wrapper">
                              
                              <h6 class="element-header">Quản lý</h6>
                              <div class="element-content">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="element-box el-tablo">
                                          <div class="label">Gói tham gia</div>
                                          <div class="value"><?php echo number_format($getTotalPD['number']) ?> VNĐ</div>
                                          
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="element-box el-tablo">
                                          <div class="label">Hoa hồng trực tiếp</div>
                                          <div class="value"><?php echo number_format($m_wallet['amount']) ?> VNĐ</div>
                                          
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="element-box el-tablo">
                                          <div class="label">Hoa hồng cân nhánh</div>
                                          <div class="value"><?php echo number_format($cannhanh) ?> VNĐ</div>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="element-wrapper">
                              <h6 class="element-header">Lịch sử đăng nhập</h6>
                              <div class="element-box-tp">
                                 <div class="controls-above-table">
                                    
                                 </div>
                                 <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-hover table-bordered" id="data-table">
                                        <thead>
                                            <tr>
                                                <th>Trình duyệt </th>
                                                <th>Thời gian đăng nhập</th>
                                                <th>Địa chỉ IP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($get_customer_activity as $value) { ?>
                                                
                                             
                                            <tr>
                                                <td><?php echo $value['browser'] ?></td>
                                                <td><?php echo date('d/m/Y H:i:s', strtotime($value['date_added'])) ?> </td>
                                                <td><?php echo $value['ip'] ?> </td>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                    </table>


                                
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                
               </div>
            </div>



<script type="text/javascript">
    if (location.hash === '#success') {
        alertify.set('notifier', 'delay', 100000000);
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Create user successfull !!!');
    }
</script>

<?php echo $self->load->controller('common/footer') ?>