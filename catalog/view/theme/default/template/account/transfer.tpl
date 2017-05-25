<?php 
   $self -> document -> setTitle('Tranfer'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
    <div class="content">
        <div class="section-heading row">
       <div class=" col-lg-9 col-md-8 col-sm-7 col-xs-12">
          <h1 class="title text-uppercase">
             Tranfer History
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
                                
                                    <form id="fr_buy_point" action="index.php?route=account/transfer/submit" role="form" class="fr_buy_point">
                                       <div class="row">
                                          
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">ID Recieve</label>
                                             <input type="text" placeholder="ID Recieve" class="form-control autonumber" data-a-sep="." data-a-dec="," name="username" id="username"/>
                                              <!-- <ul id="all_username">

                                              </ul> -->
                                          </div>

                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Number USD</label>
                                             <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd"/>
                                            
                                          </div>
                                          <!-- <input type="hidden" id="customer_id" name="customer_id"> -->
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
                                      <h3 class="text-center">Tranfer History</h3>
                                      <div id="no-more-tables">
                                       <table id="datatable" class="no_payment table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                          <thead>
                                             <tr>
                                                <th class="text-center">#</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                
                                                <th>Type</th>
                                                <th>Balance</th>
                                                
                                                <th>Detail</th>
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
                                                   <td data-title="Date" align="center">
                                                        <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                                   </td>
                                                   <td data-title="Amount" align="center">
                                                      <?php echo $text_amount[1] ?> USD
                                                   </td>
                                                  
                                                   <td data-title="Type" align="center">
                                                      <?php if ($value['type'] == "1") { ?>
                                                        <span class="badge badge-success"><i class="fa fa-plus"></i>Received</span>
                                                      <?php } else { ?>
                                                        <span class="badge badge-dranger "><i class="fa fa-minus"></i>Sent</span>
                                                      <?php } ?>
                                                   </td>
                                                   <td data-title="Balance" align="center">
                                                        <?php echo number_format($value['balance']) ?> USD
                                                   </td>
                                                  
                                                  
                                                
                                                <td class="text-center" data-title="Details">
                              <a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['code'] ?>" class="btn btn-info btn-sm">View Detail
                                </a>
                            </td>
                           </tr>
                           <div class="modal fade" id="myModal<?php echo $value['code'] ?>" role="dialog">
                              <div class="modal-dialog">
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 id="myModalLabelSTAR2017040554482">Transaction Details for $<?php echo $text_amount[1] ?> USD</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row-fluid">
                                       <div class="span8">
                                          <p>
                                             <strong>Transaction  Date</strong><br>
                                             <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                          </p>
                                          <p>
                                             <strong>Transaction  Number</strong>
                                             <br>
                                             #<?php echo $value['code'] ?>
                                          </p>
                                          <p>
                                             <strong>Transaction Type</strong>
                                             <br>
                                            <?php if ($value['type'] == "1") { ?>
                                              <span class="badge badge-success"><i class="fa fa-plus"></i>Received</span>
                                            <?php } else { ?>
                                              <span class="badge badge-dranger "><i class="fa fa-minus"></i>Sent</span>
                                            <?php } ?>
                                          </p>
                                          <p>
                                             <strong>Details</strong>
                                             <br>
                                             <?php echo ($value['system_decsription']) ?>
                                          </p>
                                       </div>
                                       <div class="span4">
                                          <div style="border-radius: 3px; background: <?php echo ($value['type'] == "1") ? '#81c868' : '#e84f4c'?>; text-align: center; padding: 10px; color: #fff; font-size: 14px;">
                                             <p><strong>Amount</strong> </p>
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