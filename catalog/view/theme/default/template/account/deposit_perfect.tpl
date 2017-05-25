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
                                    <form id="fr_buy_point_perfect" action="index.php?route=account/deposit/submit_perfect" role="form" class="fr_buy_point">
                                       <div class="row">
                                           <div class="form-group">
                                             <label for="exampleInputEmail1">Payment Method</label>
                                            <select class="form-control" id="payment_method" name="payment_method"/>
                                              <option value="bitcoin">Bitcoin</option>
                                              <option selected="selected" value="perfect">Perfect Money</option>
                                              <option value="payeer">Payeer</option>
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
                                                    <?php if ($value['confirmations'] == 0) { ?>
                                                      <form action="https://perfectmoney.is/api/step1.asp" method="POST"> <input type="hidden" name="PAYEE_ACCOUNT" value="U14987954"> <input type="hidden" name="PAYEE_NAME" value="Mackayshieldslife"> <input type="hidden" name="PAYMENT_UNITS" value="USD"> <input type="hidden" name="STATUS_URL" value="<?php echo HTTPS_SERVER.'callback_pm' ?>"> <input type="hidden" name="PAYMENT_URL" value="<?php echo HTTPS_SERVER.'deposit.html?type=perfect' ?>"> <input type="hidden" name="NOPAYMENT_URL" value="<?php echo HTTPS_SERVER.'deposit.html?type=perfect' ?>"> <input type="hidden" name="PAYMENT_ID" value="<?php echo $value['invoice_id_hash'] ?>"> <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $value['amount_usd']/10000 ?>"> <input type="submit" class="btn btn-info" name="PAYMENT_METHOD" value="Payment"></form>


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