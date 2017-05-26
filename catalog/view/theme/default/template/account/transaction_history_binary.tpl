<?php 
   $self -> document -> setTitle('Hoa hồng đội nhóm'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-w">
  <div class="content-page">
      
          <div class="section-heading">
         <div class="col-xs-12">
            <h1 class="title text-uppercase">
              HOA HỒNG CÂN NHÁNH
            </h1>
         </div>
         
      </div>
  </div>
    <div class="">

   <div class="content">
      
      <div class="">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                 
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12 table-responsive" id="no-more-tabless">
                           <div class="table-responsive">
                              <table class="table table-condensed table-striped table-hover table-bordered" id="data-table">
                                 <thead>
                                    <tr>
                                       <th class="text-center">#</th>
                                       <th>Mã giao dịch</th>
                                       <th>Thời gian</th>
                                       <th>Số tiền</th>
                                       <th>Chi tiết</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (count($histotys) > 0) { ?>
                                    <?php $i = 0; foreach ($histotys as $value) { $i++; ?>
                                    <?php 
                                       $text_amount = explode(" ", $value['text_amount']);
                                       ?>
                                    <tr>
                                       <td data-title="#" align="center">
                                          <?php echo $i ?>
                                       </td>
                                       <td data-title="Mã giao dịch" align="center">
                                          <?php echo $value['code'] ?>
                                       </td>
                                       <td data-title="Thời gian" align="center">
                                          <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                       </td>
                                       <td data-title="Số tiền" align="center">
                                          <?php echo $text_amount[1] ?> VNĐ
                                       </td>
                                       
                                       <td class="text-center" data-title="Chi tiết">
                                          <a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['code'] ?>" class="btn btn-info btn-sm">Xem chi tiết
                                          </a>
                                       </td>
                                    </tr>
                                    <div class="modal fade" id="myModal<?php echo $value['code'] ?>" role="dialog">
                                       <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 >Hoa hồng đội nhóm <?php echo $text_amount[1] ?> VNĐ</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row-fluid">
                                                   <div class="span8">
                                                      <p>
                                                         <strong>Thời gian</strong><br>
                                                         <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                                      </p>
                                                      <p>
                                                         <strong>Mã giao dịch</strong>
                                                         <br>
                                                         #<?php echo $value['code'] ?>
                                                      </p>
                                                      
                                                      <p>
                                                         <strong>Mô tải</strong>
                                                         <br>
                                                         <?php echo ($value['system_decsription']) ?>
                                                      </p>
                                                   </div>
                                                   <div class="span4">
                                                      <div style="border-radius: 3px; background: <?php echo ($value['type'] == "1") ? '#81c868' : '#e84f4c'?>; text-align: center; padding: 10px; color: #fff; font-size: 14px;">
                                                         <p><strong>Số tiền</strong> </p>
                                                         <h3>$<?php echo $text_amount[1] ?></h3>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="clearfix"></div>
                                       </div>
                                    </div>
                           </div>
                           <?php } ?>
                           <?php } else { ?>
                           <tr>
                           <td colspan="7" align="center">Không có dữ liệu
                           </td>
                           </tr>
                           <?php } ?>
                           </tbody>
                           </table>
                           <div class="text-center">
                              <?php echo $pagination; ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
         <!-- End Row -->
      </div>
   </div>
</div>
<!-- End row -->
</div>
<?php echo $self->load->controller('common/footer') ?>