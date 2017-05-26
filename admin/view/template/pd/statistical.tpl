<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
  <div class="container-fluid">
    <h1>Thống kê</h1>

  </div>
</div>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title show_button">Thống kê</h3>
    
    </div>
      <div class="clearfix" style="margin-top: 20px;"></div>
      <div class="text-center">
      <?php if (isset($_SESSION['export'])) if ($_SESSION['export'] == "export"){ ?>
        <div class="alert alert-success">
          <strong>Success!</strong> Xuất file excel thành công.
        </div>
      <?php } ?>
      <?php if (isset($_SESSION['hoahong'])) { ?>
        <div class="alert alert-success">
          <strong>Success!</strong> Tính lãi thành công.
        </div>
      <?php } ?>
      <?php if (isset($_SESSION['export'])) if ($_SESSION['export'] == "nodata"){ ?>
        <div class="alert alert-danger">
          <strong>Danger!</strong> Không có dữ liệu xuất trong ngày hôm nay.
        </div>
      <?php } ?>
    
    <div class="clearfix" style="margin-top: 30px;"></div>
    <table>
      <thead>
        <tr>
          <th>Hoa hồng trực tiếp</th>
           <th>Hoa hồng cân nhánh</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            
              <a onclick="return confirm('Bạn có chắc chắn không?')" class="click" href="index.php?route=report/exportCustomerid/export_c_wallet&token=<?php echo $_GET['token'];?>">
              <button type="button" class="btn btn-warning">Tính lãi trực tiếp (Hằng ngày)</button>
              </a>
            
          </td>
          <td>
            
              <a onclick="return confirm('Bạn có chắc chắn không?')" class="click" href="index.php?route=report/exportCustomerid/export_commission_binary&token=<?php echo $_GET['token'];?>">
              <button type="button" class="btn btn-warning">Tính hoa hồng cân nhánh (30)</button>
              </a>
            
          </td>
        </tr>
      </tbody>
    </table>
    <br><br>
    
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

$('.click').click(function() {
  jQuery(this).hide();  
});
$('.show_button').click(function(){
  $('.click').show();
});
</script>
<?php echo $footer; ?>
<style type="text/css" media="screen">
  ul#suggesstion-box li:hover {
    cursor: pointer;
    background-color: #E27225;
    color: #fff;
  }
  table{
    width: 100%;
  }
  table td, table th{
    width: 50%; 
    text-align: center;
  }
  table th{
    font-size: 25px;
    height: 50px;
  }
  table td h1{
    color: red;
  }
  .click{
    display: none;
  }
</style>

