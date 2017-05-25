<?php 
   $self -> document -> setTitle(' Message '); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
    <div class="content">
        <div class="section-heading row">
       <div class=" col-lg-9 col-md-8 col-sm-7 col-xs-12">
          <h1 class="title text-uppercase">
             Message
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
     
    <div class="page-content container-fluid">
        <div class="main-dashboard">
   <div class="row rule" style="margin-top:0;">
        <div class="col-md-12" id="anouncenment">
            <div class="panel panel-default">
              
                <div class="panel-body" style="min-height:335px;">
                    <table class="table table-striped table-bordered dataTable no-footer">
                       <thead class="thead-bg">
                          <tr>
                             
                             <th class="text-center">Sender</th>
                             <th class="text-center">Subject</th>
                             <th class="text-center">Date</th>
                          </tr>
                       </thead>
                       <tbody>
                          <tr class="message-viewed">
                             
                             <td>
                                Admin
                             </td>
                             <td>
                                <span class="ellipsis-mess">
                                <a href="#">Welcome to Mackayshieldslife</a>
                                <span class="message-holder">
                                - Dear <?php echo $customer['firstname'] ?><br>
                                <span class="ellipsis-mess">
                                Please complete the information in the settings to perform functions of the program
                                </span><br>
                                <span class="ellipsis-mess">
                                Best regards
                                </span><br>
                                <span class="ellipsis-mess">
                                The Mackayshieldslife Team

                               
                                </span>
                             </td>
                             <td class="text-center"><?php echo date('d/m/Y',strtotime($customer['date_added']))  ?></td>
                          </tr>
                          
                       </tbody>
                    </table>
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