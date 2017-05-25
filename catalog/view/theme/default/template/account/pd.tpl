<?php $self -> document -> setTitle("Gói đầu tư"); echo $self -> load -> controller('common/header'); echo $self -> load -> controller('common/column_left'); ?>
<div class="content-w">
  <div class="content-page">
      
          <div class="section-heading">
         <div class="col-xs-12">
            <h1 class="title text-uppercase">
              Gói đầu tư
            </h1>
         </div>
         
      </div>
  </div>
<div class="content-page">
    <div class="content">
        
        <div class="cb-page-content">
            <div class="container">
                <div class="row">
      <div class="col-md-12">
      <?php if(count($pds) > 0){?> 
         <div class="">
            <div class="">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 table-responsive" id="no-more-tabless">
                   
                      <table class="table table-condensed table-striped table-hover table-bordered" id="data-table">
                     
                        <thead>
                           <tr>
                              <th>#</th>
 							                <th>Mã giao dịch</th>
                              <th>Thời gian</th>
                              <th>Gói tham gia</th>
                              <th>Thời gian hết hạn</th>
                              <th>Chi tiết</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $i=0; foreach ($pds as $value=> $key){ $i++?> 
                           <tr>
                            <td data-title="#"><?php echo $i ?></td>
        					           <td data-title="Mã giao dịch">#<?php echo $key['pd_number'] ?></td>
                            <td data-title="Thời gian"><?php echo date("d/m/Y H:i:s", strtotime($key['date_added'])); ?></td>
                              
                            <td data-title="Gói tham gia">
                              	<?php echo (number_format($key['filled'])) ?> VNĐ
                            </td>
                            <td class="text-center text-danger countdown" data-title="Thời gian hết hạn" data-countdown="<?php echo $key['date_finish'] ?>" > Đang tải...</td>
                      
                            <td class="text-center" data-title="Chi tiết">
                              <a href="#" data-toggle="modal" data-target="#myModal<?php echo $key['pd_number'] ?>" class="btn btn-info btn-sm">Xem chi tiết
                                </a>
                            </td>
                           </tr>
                           <div class="modal fade" id="myModal<?php echo $key['pd_number'] ?>" role="dialog">
                              <div class="modal-dialog">
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 id="myModalLabelSTAR2017040554482">Chi tiết giao dịch #<?php echo (($key['pd_number'])) ?></h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row-fluid">
                                       <div class="span8">
                                          <p>
                                             <strong>Thời gian giao dịch</strong><br>
                                             <?php echo date("d/m/Y H:i:s", strtotime($key['date_added'])); ?>
                                          </p>
                                          <p>
                                             <strong>Mã giao dịch</strong>
                                             <br>
                                             #<?php echo $key['pd_number'] ?>
                                          </p>
                                          <p>
                                             <strong>Chi tiết</strong>
                                             <br>
                                             Tham gia gói <?php echo (number_format($key['filled'])) ?> VNĐ
                                          </p>
                                       </div>
                                       <div class="span4">
                                          <div style="border-radius: 3px; background: #59AD7B; text-align: center; padding: 10px; color: #fff; font-size: 14px;">
                                             <p><strong>Gói</strong> </p>
                                             <h3><?php echo (number_format($key['filled'])) ?> VNĐ</h3>
                                          </div>
                                       </div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                 
                                </div>
                                
                              </div>
                            </div>
                           <?php }?> 
                        </tbody>
                     </table>
                  </div>
               </div>
              
               
            </div>
         </div>
         <?php } ?>

         </div>
      <div class="clearfix"></div>
      <div class="" style="width: 100%">

        <div class="col-md-6">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <span class="heading">
                      <?php $packet = $self -> check_packet_pd (2500000) ;?>
                      <?php if(count($packet) > 0) { ?>
                        <?php if (intval($packet['status']) === 0) {?>
                          <h3>Gói đã hết hạn</h3>
                        <?php } else { ?>
                          <h3>Đã kích hoạt</h3>
                        <?php } } else { ?>
                          <h3>Chưa kích hoạt</h3>
                      <?php } ?>
                    </span>
                    <span class="price-value"><span class="currency"></span>2.500.000 VNĐ<span class="mo"> </span></span>
                </div>
 
                <?php if(count($packet) > 0) { ?>
                  <?php if (intval($packet['status']) === 0) {?>
                    <form class="packet-invest-upgray" action="index.php?route=account/pd/upgray_investment">
                      <input type="hidden" name="packet" value="2500000">

                      <div class="pricingTable-sign-up ">
                        <p>Vui lòng nhập mã Code để gia hạn gói</p>
                      </div>
                      <input placeholder="Mã Code" class="form-control form_code" style="width: 80%" type="text" name="code">
                      <div class="pricingTable-sign-up ">
                          <button type="submit" class="btn btn-block btn-default">Gia hạn gói</button>
                      </div>
                    </form>
                  <?php } else { ?>
                  <div class="pricingTable-sign-up " style="margin-top: 100px;">
                    <button disabled="true" class="btn btn-block btn-default">Bạn đã tham gia gói này</button>
                  </div>
                  <?php } } else { ?>
                    <form class="packet-invest" action="index.php?route=account/pd/pd_investment">
                      <input type="hidden" name="packet" value="2500000">

                      <div class="pricingTable-sign-up ">
                        <p>Vui lòng nhập mã Code để kích hoạt</p>
                      </div>
                      <input placeholder="Mã Code" class="form-control form_code" style="width: 80%" type="text" name="code">
                      <div class="pricingTable-sign-up ">
                          <button type="submit" class="btn btn-block btn-default">Tham gia gói</button>
                      </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <span class="heading">
                      <?php $packet = $self -> check_packet_pd (5600000) ;?>
                      <?php if(count($packet) > 0) { ?>
                        <?php if (intval($packet['status']) === 0) {?>
                          <h3>Gói đã hết hạn</h3>
                        <?php } else { ?>
                          <h3>Đã kích hoạt</h3>
                        <?php } } else { ?>
                          <h3>Chưa kích hoạt</h3>
                      <?php } ?>
                    </span>
                    <span class="price-value"><span class="currency"></span>5.600.000 VNĐ<span class="mo"></span></span>
                </div>
 
                
                <?php if(count($packet) > 0) { ?>
                  <?php if (intval($packet['status']) === 0) {?>
                    <form class="packet-invest-upgray" action="index.php?route=account/pd/upgray_investment">
                      <input type="hidden" name="packet" value="5600000">

                      <div class="pricingTable-sign-up ">
                        <p>Vui lòng nhập mã Code để gia hạn gói</p>
                      </div>
                      <input placeholder="Mã Code" class="form-control form_code" style="width: 80%" type="text" name="code">
                      <div class="pricingTable-sign-up ">
                          <button type="submit" class="btn btn-block btn-default">Gia hạn gói</button>
                      </div>
                    </form>
                  <?php } else { ?>
                  <div class="pricingTable-sign-up ">
                    <button disabled="true" class="btn btn-block btn-default" style="margin-top: 100px;">Bạn đã tham gia gói này</button>
                  </div>
                  <?php } } else { ?>
                    <form class="packet-invest" action="index.php?route=account/pd/pd_investment">
                      <input type="hidden" name="packet" value="5600000">

                      <div class="pricingTable-sign-up ">
                        <p>Vui lòng nhập mã Code để kích hoạt</p>
                      </div>
                      <input placeholder="Mã Code" class="form-control form_code" style="width: 80%" type="text" name="code">
                      <div class="pricingTable-sign-up ">
                          <button type="submit" class="btn btn-block btn-default">Tham gia gói</button>
                      </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        

      </div>


   </div>
</div>
</div><?php echo $self->load->controller('common/footer') ?>