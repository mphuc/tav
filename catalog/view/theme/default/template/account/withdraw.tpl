<?php 
   $self -> document -> setTitle('Withdraw'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
    <div class="content">
        <div class="section-heading row">
       <div class=" col-lg-9 col-md-8 col-sm-7 col-xs-12">
          <h1 class="title text-uppercase">
             Withdraw History
          </h1>
       </div>
       
    </div>
  </div>
</div>
<div class="content-page">
   <div class="content">
     
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
                                  <?php if (!isset($_GET['type']) || $_GET['type'] == 'bitcoin') { ?>
                                    <form id="fr_buy_point" action="index.php?route=account/withdraw/submit" role="form" class="fr_buy_point">
                                       <div class="row">
                                          <!-- <div class="form-group">
                                             <label for="exampleInputEmail1">Choose payment method</label>
                                            <select class="form-control" id="payment_method" name="payment"/>
                                              <option selected="selected" value="bitcoin">Bitcoin</option>
                                              <option  value="perfect">Perfect Money</option>
                                              <option  value="payeer">Payeer</option>
                                            </select>
                                          </div> -->
                                          <div class="form-group" style="margin-bottom: 0px;">
                                             <label for="exampleInputEmail1">Wallet payment</label>
                                             <input type="text" class="form-control" name="wallet" value="<?php echo $customer['wallet'] ?>" id="wallet_addres" readonly="true" />
                                            
                                          </div>
                                          <div class="col-md-6" style="padding: 0; padding-right: 10px;">
                                             <label for="exampleInputEmail1">Number USD</label>
                                             <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd"/>
                                            
                                          </div>
                                          <div class="col-md-6 " style="padding: 0;padding-left: 10px;">
                                             <label for="exampleInputEmail1">Number BTC</label>
                                             <input type="text" readonly="true" placeholder="Number BTC" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_btc" id="ip_btc"/>
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Password Transaction</label>
                                             <input type="password" class="form-control" id="password_transaction" name="password_transaction" placeholder="Password Transaction" />
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="alert alert-danger pendding_withdraw" style="display: none;">
                                            <strong>Warning:</strong> Please wait for the withdrawal order to end.
                                          </div>
                                          <br/>
                                            <button style="width: 100%" type="submit" class="btn btn-success btn-md">
                                              Submit
                                            </button>
                                       </div>
                                    </form>
                                    <?php } ?>

                                    <?php if (isset($_GET['type']) && $_GET['type'] == 'perfect') { ?>
                                      <form id="fr_buy_point_perfect" action="index.php?route=account/withdraw/submit_perfect" role="form" class="fr_buy_point">
                                       <div class="row">
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Choose payment method</label>
                                            <select class="form-control" id="payment_method" name="payment"/>
                                              <option  value="bitcoin">Bitcoin</option>
                                              <option selected="selected" value="perfect">Perfect Money</option>
                                              <option  value="payeer">Payeer</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Wallet payment</label>
                                             <input type="text" class="form-control" name="wallet" value="<?php echo $customer['perfect_money'] ?>" id="wallet_addres" readonly="true" />
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Number USD</label>
                                             <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd"/>
                                            
                                          </div>
                                          
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Password Transaction</label>
                                             <input type="password" class="form-control" id="password_transaction" name="password_transaction" placeholder="Password Transaction" />
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="alert alert-danger pendding_withdraw" style="display: none;">
                                            <strong>Warning:</strong> Please wait for the withdrawal order to end.
                                          </div>
                                          <br/>
                                            <button style="width: 100%" type="submit" class="btn btn-success btn-md">
                                              Submit
                                            </button>
                                       </div>
                                    </form>
                                    <?php } ?>

                                    <?php if (isset($_GET['type']) && $_GET['type'] == 'payeer') { ?>
                                      <form id="fr_buy_point_payeer" action="index.php?route=account/withdraw/submit_payeer" role="form" class="fr_buy_point">
                                       <div class="row">
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Choose payment method</label>
                                            <select class="form-control" id="payment_method" name="payment"/>
                                              <option  value="bitcoin">Bitcoin</option>
                                              <option  value="perfect">Perfect Money</option>
                                              <option selected="selected" value="payeer">Payeer</option>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Wallet payment</label>
                                             <input type="text" class="form-control" name="wallet" value="<?php echo $customer['payeer'] ?>" readonly="true" id="wallet_addres"  />
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Number USD</label>
                                             <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd"/>
                                            
                                          </div>
                                          
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Password Transaction</label>
                                             <input type="password" class="form-control" id="password_transaction" name="password_transaction" placeholder="Password Transaction" />
                                          </div>
                                          <div class="clearfix"></div>
                                          <div class="alert alert-danger pendding_withdraw" style="display: none;">
                                            <strong>Warning:</strong> Please wait for the withdrawal order to end.
                                          </div>
                                          <br/>
                                            <button style="width: 100%" type="submit" class="btn btn-success btn-md">
                                              Submit
                                            </button>
                                       </div>
                                    </form>
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
                                      <h3 class="text-center">Withdraw History</h3>
                                      <div id="no-more-tables">
                                       <table id="datatable" class="no_payment table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                          <thead>
                                             <tr>
                                                <th class="text-center">No.</th>
                                                <th>Amount USD</th>
                                               
                                                <th>Amount BTC</th>
                                                <th>Wallet Payment</th>
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
                                                      <?php echo number_format($value['amount_usd']) ?> USD
                                                   </td>
                                                  
                                                   <td data-title="Amount BTC" align="center">
                                                      
                                                        <?php echo $value['amount_payment']/100000000 ?> BTC
                                                    
                                                      
                                                   </td>
                                                   <td data-title="Wallet Payment" align="center">
                                                       <?php echo $value['addres_wallet'] ?>
                                                     
                                                   </td>
                                                  <td data-title="Date" align="center">
                                                     <?php echo date('d F Y H:i',strtotime(
                                                     $value['date_added'])) ?>
                                                   </td>
                                                   <td data-title="Status" align="center">
                                                    <?php if ($value['status'] == 0) { ?>
                                                      <span style="cursor: pointer; padding:6px;" id="payment_complete" onclick="show_payment('<?php echo $value['invoice_id'] ?>')" class="label label-danger"><i style="font-size: 14px;" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> Pendding...</span>
                                                    <?php } else { ?>
                                                    
                                                      <span style="cursor: pointer; padding:6px;" id="payment_complete"  class="label label-success">Finish</span>
                                                      <?php } ?>
                                                   </td>
                                                </tr>
                                               <?php } ?>
                                               <?php } else { ?>
                                                <tr>
                                                   <td colspan="6" align="center">No data
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