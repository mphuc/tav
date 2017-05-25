<?php 
   $self -> document -> setTitle('Stock'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
?>
<div class="content-page">
  <div class="content">
    <div class="page-title-group">
        <h4 class="page-title">Stock</h4>
        <h5 class="text-muted page-title-alt"></h5>
    </div>
    <div class="cb-page-content">
        <div class="container">
    <div class="  ">
      <div class="btn-group">
      <a type="button" id="request-withdrawal-btn" class="btn btn-primary btn-lg" href="sell_stock.html" aria-label="Left Align" style="padding: 7px 25px; margin-bottom: 35px;">
      <i class="fa fa-shopping-bag" aria-hidden="true"></i> 
        Sell Stock
      </a>
      </div>
      </div>
    </div>
  </div>
    <div class="cb-page-content">
        <div class="container">
            <div class="row">
              <div class="col-md-9">
                    <div class="card-box">
                      <div class="panel-heading text-uppercase">
                        <h3 class="title">
                          Transaction history
                        </h3>
                        <table class="table table-small" data-pseudo-paginable="true">
                          <thead class="thead-bg">
                            <tr>
                              <th class="text-center">Date</th>
                              <th class="text-center">Description</th>
                              
                              <th class="text-center">Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($double_stock as $values) { ?>
                            
                         
                          <tr>
                            <th class="text-center"><?php echo date('d/m/Y',strtotime($values['date_added'])) ?></th>
                            <td class="text-left"><?php echo $values['system_decsription'] ?></td>
                            
                            <td class="text-danger text-center">
                            <?php echo $values['text_amount'] ?>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
              </div>
              <div class="col-md-3">
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
        </div>
      </div>
    </div>
    <!--  -->
    <div class="clearfix"></div>
     <div class="cb-page-content hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="card-box-head  border-b m-t-0">
                            <h4 class="header-title"><b>Stock list</b></h4>
                        </div>
                        <div class="card-box-content p-l-0 p-r-0 btn-compoenent">
                            <table id="datatable" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th class="text-center">#</th>
                                       <th>Date Active</th>
                                       <th>Amount</th>
                                       <th>Status</th>
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
                                       <td data-title="Date Active" align="center">
                                          <?php echo date('d-F-Y H:i A',strtotime($value['date_finish'])) ?>
                                       </td>
                                       <td data-title="Amount" align="center">
                                          <?php echo number_format($value['amount']/10000) ?> USD
                                       </td>
                                       <td data-title="Status" align="center">
                                          <?php if ($value['status'] == "1") { ?>
                                          <span class="badge badge-success">Active</span>
                                          <?php } else { ?>
                                          <span class="badge badge-dranger ">Not Active</span>
                                          <?php } ?>
                                       </td>
                                       
                                       <td class="text-center" data-title="Detail">
                                          <a href="#" data-toggle="modal" data-target="#myModal<?php echo $value['id'] ?>" class="btn btn-info btn-sm">View Detail
                                          </a>
                                       </td>
                                    </tr>
                                    <div class="modal fade" id="myModal<?php echo $value['id'] ?>" role="dialog">
                                       <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 >Details</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="row-fluid">
                                                   <p>
                                                     Active Package <span class="badge badge-success"><?php echo number_format($value['filled']/10000) ?> USD</span>
                                                   </p>
                                                    <p>
                                                     Date Active: <?php echo date('d-F-Y H:i A',strtotime($value['date_finish'])) ?>
                                                   </p>
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
                        </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!--  -->
    <div class="clearfix"></div>
    <div class="cb-page-content hidden-sm hidden-md hidden-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="card-box-head  border-b m-t-0">
                            <h4 class="header-title"><b>Chart</b></h4>
                        </div>
                        <div class="card-box-content p-l-0 p-r-0 btn-compoenent">
                          <div class="progress-pie-chart" data-percent="<?php echo $getprice_share_child['price']/5000 *100 ?>"><!--Pie Chart -->
                              <div class="ppc-progress">
                                  <div class="ppc-progress-fill"></div>
                              </div>
                              <div class="ppc-percents">
                              <div class="pcc-percents-wrapper">
                                  <span><?php echo round($getprice_share_child['price']/10000,2) ?> USD</span>
                              </div>
                              </div>
                          </div><!--End Chart -->
                         
                        </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="clearfix"></div>
     <div class="cb-page-content hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="card-box-head  border-b m-t-0">
                            <h4 class="header-title"><b>Chart</b></h4>
                        </div>
                        <div class="card-box-content p-l-0 p-r-0 btn-compoenent">

                            <canvas id="canvas" style="height: 500px; position: relative;"></canvas>
                        </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="clearfix"></div>

    


         <?php

            $labels = $data = '';
            foreach ($getprice_share_all as $value) {
                $labels .= ","."'".date('d/m',strtotime($value['date_added']))."'";
                $data .= ","."'".($value['price']/10000)."'";
            }
            $labels = substr($labels, 1);
            $data = substr($data, 1);
           
        ?>

        <script type="text/javascript">
        $(function(){
          var $ppc = $('.progress-pie-chart'),
            percent = parseInt($ppc.data('percent')),
            deg = 360*percent/100;
          if (percent > 50) {
            $ppc.addClass('gt-50');
          }
          $('.ppc-progress-fill').css('transform','rotate('+ deg +'deg)');
          //$('.ppc-percents span').html(percent+'%');
        });
        var config = {
            type: 'line',
            data: {
                labels: [  <?php echo $labels;?> ],
                datasets: [{
                    label: ' Price (USD)',
                    fontSize: 36,
                    backgroundColor: '#0A3555',
                    borderColor: '#0A3555',
                    data: [ <?php echo $data;?> ],
                    fill: false,
                    pointBorderWidth: 3,
                    pointHoverBorderWidth: 5,
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                title: {
                    display: false,
                    text: 'Rates',
                    fontSize: 24,
                    fontStyle: 'normal',
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    xPadding: 10,
                    yPadding: 14,
                    titleFontSize: 16,
                    titleMarginBottom: 10,
                    bodyFontSize: 14,
                    footerMarginTop: 10,
                    caretSize: 10,
                    footerFontSize: 6,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date',
                            fontSize: 18,
                            fontColor: "#0A3555"
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Price (USD)',
                            fontSize: 18,
                            fontColor: "#0A3555"
                        }
                    }]
                }
            }
        };

        window.onload = function() {

            var ctx = document.getElementById("canvas").getContext("2d");
            Chart.defaults.global.defaultFontFamily = 'opensans-regular';
            window.myLine = new Chart(ctx, config);
        };
        </script>
      </div>
    </div>
  </div>
</div>

<?php echo $self->load->controller('common/footer') ?>