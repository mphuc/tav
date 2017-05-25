<?php 
   $self -> document -> setTitle('New User'); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
<div class="content-page">
    <div class="content">
        <div class="page-title-group">
            <h4 class="page-title">New user</h4>
            <h5 class="text-muted page-title-alt"></h5>
        </div>   
      <div class="cb-page-content page_setting">
          <div class="container">
              <div class="row">

    
      
        <div class="panel panel-white">
           <div class="panel-body">

                <?php if(count($user) > 0){ ?>
         <div class="card">
            <div class="card-body table-responsive" id="no-more-tables">
                  <table id="datatable" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th>Affiliate ID</th>
                        
                          <th>Email</th>
                          <th>Phone number</th>
                          
                           <th>Date Join</th>
                          <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $number = 1; foreach ($user as $key => $value) {?>
                            <tr>
                                 <td data-title="NO" align="center"><?php echo $number ?></td>
                                <td data-title="Affiliate ID"><?php echo $value['username'] ?></td>
                              
                                 <td data-title="Email"><?php echo $value['email'] ?></td>
                                 <td data-title="Phone Number"><?php echo $value['telephone'] ?></td>
                                
                                <td data-title="Date Join"><?php echo date("d F Y H:i", strtotime($value['date_added'])); ?></td>
                                
                                <td data-title="Action" class="text-center">
                                    <a href="user-edit?id=<?php echo $value['customer_code'] ?>" class="btn btn-info ">Edit</a>
                                </td>
                            </tr>
                        <?php $number++; } ?>
                     </tbody>
                  </table>
               </div>
         </div>
         <?php } ?>
               </div>
            </div>
      </div>
   </div>
   </div>
   <!-- End Row -->
   <!-- End row -->
</div>



   

<?php echo $self->load->controller('common/footer') ?>