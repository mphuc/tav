<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Tạo Code</h1>

  </div>
</div>  
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Tạo Code</h3>
    </div>
    <?php 
      if (isset($_SESSION['success'])){?>
      <div class="alert alert-success">
        <strong>Tạo!</strong> thành công.
      </div>
    <?php } ?>
    <div class="panel-body">
      <form id="" action="<?php echo $action_upgrade; ?>" method="POST" role="form">
      <div class="col-md-6 col-md-push-3">
          <label for="">Họ tên</label>
          <input type="text" autocomplete="off" required="required" class="form-control" id="username" name="username" placeholder="Họ tên">

          <br/>
          <label for="">Gói đầu tư</label>
          <select name="investment" id="investment" class="form-control" required="required">
            <option value="">Chọn gói đầu tư</option>
            <option value="2500000">2,500,000 VNĐ</option>
            <option value="5600000">5,600,000 VNĐ</option>
          </select>
          
          <br/>
          <label for="">Số lượng code</label>
          <input type="text"  required="required" class="form-control" id="number" name="number" placeholder="Số lượng" value="1">
          <br/>
        </div>
        <br/>
      <div class="clearfix"></div>
      <div class="col-md-6 col-md-offset-3">
         <div class="form-group">
            <button style="width: 100%" onclick="return confirm('Bạn chắc chắn muốn nâng cấp?');" style="margin-top: 15px;" type="submit" class="btn btn-primary">Tạo</button>
          </div>
      </div>
      </form>
      
    </div>
  </div>
</div>


<?php echo $footer; ?>
<style type="text/css" media="screen">
  ul#suggesstion-box li:hover {
    cursor: pointer;
    background-color: #E27225;
    color: #fff;
}
ul#suggesstion-box
{
    z-index: 99999;
    position: absolute;
    width: 95%;
}.alertify.ajs-resizable:not(.ajs-maximized) .ajs-dialog {
    min-width: 548px;
    min-height: 270px;
}
</style>

<script type="text/javascript">
   if (location.hash !== '') {

      var hash = location.hash.replace("#","");
      hash = hash.split("-");
     
      if(hash.length === 5){
         if(!alertify.myAlert){
           alertify.dialog('myAlert',function factory(){
             return{
               main:function(message){
                 this.message = message;
               },
               setup:function(){
                   return { 
                     buttons:[{text: "Close", key:27/*Esc*/},{text: "<a href='index.php?route=pd/create/print_code&token=<?php echo $_GET['token'];?>' target='_blank'>Print</a>", key:27/*Esc*/}],

                   };
               },
               prepare:function(){
                 this.setContent(this.message);
               },
               build:function(){
                   var errorHeader = '<span class="fa fa-check-circle fa-2x" '
                   +    'style="vertical-align:middle;color:#e10000;">'
                   + '</span> Tạo thành công.';
                   this.setHeader(errorHeader);
               }
           }});
         }
         //launch it.
          var code = "<p>Mã code: "+hash[2]+"</p>";
         var investment = "<p>Gói đầu tư: "+hash[1]+" VNĐ</p>";
        
         var username = "<p>Họ tên: "+hash[0]+"</p>";
           var phone = "<p>Số điện thoại: "+hash[3]+"</p>";
         var address = "<p>Địa chỉ: "+hash[4]+"</p>";
         
         localStorage.setItem('code',code);
         localStorage.setItem('investment',investment);
         localStorage.setItem('username',username);
         localStorage.setItem('phone',phone);
         localStorage.setItem('address',address);
        
         //alertify.myAlert(code+investment+username+phone+address);
      } 

      
   }
   
</script>