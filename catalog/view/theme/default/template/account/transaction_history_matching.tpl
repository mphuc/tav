<?php 
   $self -> document -> setTitle('Commision Resonance'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
    <div class="content">
        <div class="section-heading row">
       <div class=" col-lg-9 col-md-8 col-sm-7 col-xs-12">
          <h1 class="title text-uppercase">
             Commision Resonance
          </h1>
       </div>
       
    </div>
  </div>
</div>
<div class="content-page">
   <div class="content">
      
      <div class="cb-page-content">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default">
                    
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12" id="no-more-tables">
                              <table id="datatable" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th class="text-center">#</th>
                                       <th>Transaction Number</th>
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
                                       <td data-title="Transaction Number" align="center">
                                          <?php echo $value['code'] ?>
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
                                                <h4 >Commision Resonance $<?php echo $text_amount[1] ?> USD</h4>
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
         <!-- End Row -->
      </div>
   </div>
</div>
<!-- End row -->
</div>
<?php echo $self->load->controller('common/footer') ?>