<?php 
   $self -> document -> setTitle('Sell Stock'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
?>
<div class="content-page">
  <div class="content">
    <div class="page-title-group">
        <h4 class="page-title">Sell Stock</h4>
        <h5 class="text-muted page-title-alt"></h5>
    </div>
    
    <div class="cb-page-content">
        <div class="container">
            <div class="row">
              
              <div class="col-md-3 col-md-push-3">
                 <div class="card-box">
                    <div class="card-box-head  border-b m-t-0">
                        <h4 class="header-title"><b>Balance</b></h4>
                    </div>
                    <div class="card-box-content p-l-0 p-r-0 btn-compoenent">
                      <h3 class="list-group-item-heading">Stock Balance:</h3>
                      <p class="list-group-item-text numbers text-right"><?php echo number_format($get_share_Wallet['amount']/10000) ?> USD</p>
                    </div>
                  </div>

              </div>
              <div class="col-md-3 col-md-push-3">
                 <div class="card-box">
                    <div class="card-box-head  border-b m-t-0">
                        <h4 class="header-title"><b>Balance</b></h4>
                    </div>
                    <div class="card-box-content p-l-0 p-r-0 btn-compoenent">
                      <h3 class="list-group-item-heading">ReStock Balance:</h3>
                      <p class="list-group-item-text numbers text-right"><?php echo number_format($get_share_Wallet['amount_re']/10000) ?> USD</p>
                    </div>
                  </div>

              </div>
        </div>
      </div>
    </div>
    <!--  -->
    <!--  -->
    <div class="cb-page-content">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                    <div class="card-box">
                      <div class="panel-heading text-uppercase">
                        <h3 class="title">
                          Sell Stock
                        </h3>
                        <form id="fr_buy_point" action="index.php?route=account/share/submit" role="form" class="fr_buy_point col-md-8 col-md-push-2">
                           <div class="">
                           
                              <div class="col-md-6" style="margin-left: -5px;">
                                 <label for="exampleInputEmail1">Number USD</label>
                                 <input type="text" placeholder="Number USD !" class="form-control autonumber" data-a-sep="." data-a-dec="," name="ip_usd" id="ip_usd">
                                
                              </div>
                              
                              <div class="col-md-6">
                                 <label for="exampleInputEmail1">Password Transaction</label>
                                 <input type="password" class="form-control" id="password_transaction" name="password_transaction" placeholder="Password Transaction">
                                
                              </div>
                              <br>
                                <button style="width: 100%" type="submit" class="btn btn-success btn-md">
                                  Submit
                                </button>
                           </div>
                           
                            <div class="alert alert-danger error_submit" style="margin-top: 15px;display: none;">
                             
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
              </div>

        </div>
      </div>
    </div>
    <!--  -->
    <div class="cb-page-content">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                    <div class="card-box">
                      <div class="panel-heading text-uppercase">
                        <h3 class="title">
                          Transaction history
                        </h3>
                        <table id="datatable" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th class="text-center">#</th>
                                       <th>Transaction Number</th>
                                       <th>Date</th>
                                       <th>Amount</th>
                                       <th>Status</th>
                                       <th>Balance</th>
                                       <th>Detail</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (count($histotys) > 0) { ?>
                                    <?php $i = 0; foreach ($histotys as $value) { $i++; ?>
                                    
                                    <tr>
                                       <td data-title="#" align="center">
                                          <?php echo $i ?>
                                       </td>
                                       <td data-title="Transaction Number" align="center">
                                          <?php echo $value['code'] ?>
                                       </td>
                                       <td data-title="Date" align="center">
                                          <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                       </td>
                                       <td data-title="Amount" align="center">
                                          <?php echo number_format($value['amount']) ?> USD
                                       </td>
                                       <td data-title="Status" align="center">
                                          <?php if ($value['status'] == "1") { ?>
                                          <span class="badge badge-success">Finish</span>
                                          <?php } else { ?>
                                          <span class="badge badge-warning ">Pending</span>
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
                                                <h4 >Sell Stock $<?php echo number_format($value['amount']) ?> USD</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row-fluid">
                                                   <div class="span8">
                                                      <p>
                                                         <strong>Transaction Date</strong><br>
                                                         <?php echo date('d-F-Y H:i A',strtotime($value['date_added'])) ?>
                                                      </p>
                                                      <p>
                                                         <strong>Transaction  Number</strong>
                                                         <br>
                                                         #<?php echo $value['code'] ?>
                                                      </p>
                                                     
                                                      <p>
                                                         <strong>Details</strong>
                                                         <br>
                                                         <?php echo ($value['system_decsription']) ?>
                                                      </p>
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
                           <td colspan="7" align="center">No data
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
    
    
    <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<?php echo $self->load->controller('common/footer') ?>