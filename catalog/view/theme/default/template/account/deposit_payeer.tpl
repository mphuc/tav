<?php 
   $self -> document -> setTitle('Deposit History'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
   <div class="content">
      <div class="page-title-group">
         <h4 class="page-title">Deposit History</h4>
         <h5 class="text-muted page-title-alt"></h5>
      </div>
      <div class="cb-page-content page_setting">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 col-md-push-3">
                        <div class="panel panel-white">
                           <div class="panel-body">
                              <div class="panel-custom">
                                 <div class="item_wallet">
                                    <div class="panel-green text-center">
                                       <h3 style="margin-top: 0px;">My Wallet</h3>
                                       <h4><?php echo number_format($get_M_Wallet['amount']/10000) ?> USD</h4>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="panel-body">
                                  <?php if ($getTotalInvoid_no_payment['number'] < 5) { ?>
                                    <form id="fr_buy_point_payeer" action="index.php?route=account/deposit/submit_payeer" role="form" class="fr_buy_point">
                                       <div class="row">

                                            <div class="form-group">
                                             <label for="exampleInputEmail1">Payment Method</label>
                                            <select class="form-control" id="payment_method" name="payment_method"/>
                                              <option value="bitcoin">Bitcoin</option>
                                              <option  value="perfect">Perfect Money</option>
                                              <option selected="selected" value="payeer">Payeer</option>
                                            </select>
                                     
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Number USD</label>
                                             <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd"/>
                                            
                                          </div>
                                         
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Password Transaction</label>
                                             <input type="password" class="form-control" id="password_transaction" name="password_transaction" placeholder="Password Transaction" />
                                            
                                          </div>
                                          <br/>
                                            <button style="width: 100%" type="submit" class="btn btn-success btn-md">
                                              Submit
                                            </button>
                                       </div>
                                       
                                       
                                    </form>
                                    <?php } else { ?>
                                      <h3>Please pay the bill in advance</h3>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="clearfix"></div>
                     <div class="col-md-12">
                        <div class="panel panel-white">
                           <div class="panel-body">
                              <div role="tabpanel">
                                
                                 <div class="tab-content row" style="">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab21">
                                      <h3 class="text-center">Deposit History</h3>
                                      <div id="no-more-tables">
                                       <table id="datatable" class="no_payment table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                          <thead>
                                             <tr>
                                                <th class="text-center">No.</th>
                                                <th>Amount USD</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                              <?php if (count($histotys) > 0) { ?>
                                              <?php $i = 0; foreach ($histotys as $value) { $i++; ?>
                                               
                                                <tr>
                                                   <td data-title="No." align="center">
                                                      <?php echo $i ?>
                                                   </td>
                                                   <td data-title="Amount USD" align="center">
                                                      <?php echo number_format($value['amount_usd']/10000) ?>
                                                   </td>
                                                   <td data-title="Date" align="center">
                                                      <?php echo date('d-F-Y H:i M',strtotime($value['date_created']))  ?>
                                                   </td>

                                                   <td data-title="Status" align="center">
                                                    <?php if ($value['confirmations'] == 0) { 
                                                        $m_shop = '341103112';
                                                        $m_orderid = $value['invoice_id_hash'];

                                                        $m_amount = number_format($value['amount_usd'], 2, '.', '');
                                                        
                                                        $m_curr = 'USD';
                                                        $m_desc = base64_encode('Payment '.$value['invoice_id_hash']);
                                                        $m_key = 'O1aovplOQM1o8jy3';

                                                        $arHash = array(
                                                            $m_shop,
                                                            $m_orderid,
                                                            $m_amount,
                                                            $m_curr,
                                                            $m_desc
                                                        );
                                                        $arHash[] = $m_key;
                                                        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

                                                    ?>
                                                      
                                                    <form method="GET" action="https://payeer.com/merchant/"><input type="hidden" name="m_shop" value="<?php echo $m_shop ?>"><input type="hidden" name="m_orderid" value="<?php echo $m_orderid ?>"><input type="hidden" name="m_amount" value="<?php echo $m_amount ?>"><input type="hidden" name="m_curr" value="<?php echo $m_curr ?>"><input type="hidden" name="m_desc" value="<?php echo  $m_desc ?>"><input type="hidden" name="m_sign" value="<?php echo $sign ?>"><input type="submit" class="btn btn-info" name="m_process" value="Payment"/></form>



                                                    <?php } ?>
                                                    <?php if ($value['confirmations'] == 3) { ?>
                                                      <span style="cursor: pointer; padding:6px;" id="payment_complete"  class="label label-success">Finish</span>
                                                    <?php } ?>
                                                   </td>
                                                </tr>
                                               <?php } ?>
                                               <?php } else { ?>
                                                <tr>
                                                   <td colspan="5" align="center">No data
                                                   </td>
                                                </tr>
                                               <?php } ?>
                                          </tbody>
                                       </table>
                                       </div>
                                       <div class="text-center">
                                        <?php echo $pagination ?>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End Row -->
   <!-- End row -->
</div>
<?php echo $self->load->controller('common/footer') ?>