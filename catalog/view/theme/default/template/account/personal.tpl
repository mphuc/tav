<?php echo $header; ?>
<?php echo $column_left; ?>
<div class="content-w">
  <div class="content-page">
      
          <div class="section-heading">
         <div class="col-xs-12">
            <h1 class="title text-uppercase">
              Cây hệ thống
            </h1>
         </div>
         
      </div>
  </div>

<div class="content-page">
    <div class="content">
        
        <div class="cb-page-content">
            <div class="container">
                <div class="row">
   
      <div class="" style="width: 100%">
        
        <div id="tab-binary" class="tab-pane panel-body active">
          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="container-fluid">
                <fieldset>


                  <div class="personal_contain" style="padding:0px;" >
                    <div class="tootbar-top">
                      <ul class="list-unstyled" style="float: left;">
                        <li style="margin-bottom:15px;">
                          <a class="" href="javascript:void(0)" onclick='click_node(
                          <?php echo intval($idCustomer); ?>)'> <span class="btn btn-info btn-md" style="font-weight:700">Quay lại đầu</span> </a>
                        
                          <a class="" href="javascript:void(0)" onclick='click_back()'> <span class="btn btn-info btn-md" style="font-weight:700">Quay lại</span> </a>
                        </li>
                        
                      </ul>
                      <div class="formsearch" style="margin-top: 0px; margin-left: 40px; display:inline-block!important; float: left;">      
                         <ul id="suggesstion-box" class="list-group" style="position: absolute;width: 200px;"></ul>
                         <form method="GET" id="frmAccount" action="<?php echo $self->url->link('account/personal/searchBinary', '', 'SSL'); ?>">

                            <input type="text"  autocomplete="off" name="account"  id="account" placeholder="Username" required style=" height: 38px; padding: 5px; border-radius: 3px; border: 1px solid #d0dee2; ">
                            <button style="margin-top: -5px;" type="submit" id="btnAccount" class="btn btn-info btn-md">Search</button>
                         </form>
                      </div>
                      <?php if (intval($user) > 0 && 1==2) {  ?>
  
                        <u style="margin-left: 30px">New User:</u> <a style="margin-left: 20px;" href="user.html" class="btn btn-danger">View Detail</a>
                        
                    <?php } ?>
                     <div class="clearfix"></div>
                    </div>
                    <div class="clr"></div>
                    <div class="personal-tree" style="text-align: center; min-height:300px">
                      <img src="
                      <?php echo $self -> config -> get('config_ing_loading'); ?>" />
                    </div>
                    
                  </div>
                </fieldset>
              
              </div>
              <div class="detail-icon" style="margin-top: 50px;">
                <img src="catalog/view/theme/default/css/icons/open.png" width="30px">- Tài khoản chưa kích hoạt
                <img src="catalog/view/theme/default/css/icons/1.png" width="30px">- Tài khoản chưa đã hoạt
                <img src="catalog/view/theme/default/css/icons/red.png" width="30px">- Tạo tài khoản
              </div>
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

<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/css/tooltipster.bundle.min.css" />
<script type="text/javascript" src="catalog/view/javascript/tooltipster.bundle.min.js"></script>
<script type="text/javascript">
     $(document).ready(function(){
   
    $('#frmAccount').on('submit', function(envt) {        
          $(this).ajaxSubmit({
              type : 'GET',
              beforeSubmit :  function(arr, $form, options) { 
                  /*window.funLazyLoad.start();
                  window.funLazyLoad.show();*/
           },
              success : function(result){
                  result = $.parseJSON(result);
                  setTimeout(function(){

                    window.click_node(result.id_tree);
                   /* window.funLazyLoad.reset();*/
                  },200);
                  
              }
          });
       
      return false;
    });
    
    }); 
    
  </script>
<script type="text/javascript">

  


(function($) {
jQuery.fn.show_tree = function(node) {  

    positon = node.iconCls.split(" ");

    var line_class = positon[1]+'line '+'linefloor'+node.fl;
    var level_active = positon[0]+'iconLevel';

    var node_class = positon[1]+'_node '+'nodefloor'+node.fl;
    var html = '<div class=\''+line_class+'\'></div>';
    
    x_p = "<div class='customer_toolip'>";
    x_p += "<p class='h3'>"+node.username+"</p>";
    x_p += "<table class='table table-bordered'><tbody><tr>";
    x_p += "<td colspan='2'> <div align='center'> <img src='"+node.img_profile+"' height='20'></div> </td></tr>";
    x_p += "<tr><td> <div align='center'>Người bảo trợ</div> </td> <td> <div align='center'>"+node.sponsor+"</div> </td></tr>";
    x_p += "<tr><td> <div align='center'>Ngày đăng ký</div> </td> <td> <div align='center'>"+node.date_added+"</div> </td></tr>";
    x_p += "<tr><td> <div align='center'>Gói tham gia</div> </td> <td> <div align='center'>"+node.totalPD+" VNĐ</div> </td></tr>";
    x_p += "<tr><td> <div align='center'>Nhánh yếu</div> </td> <td> <div align='center'>"+node.PDnhanhyeu+" VNĐ</div> </td></tr>";
    
    x_p += "<tr><td> <div align='center'>Số F1</div> </td> <td> <div align='center'>"+node.numberf1+"</div> </td></tr>";
    
    html += !node.empty 
        ? '<div class=\''+node_class+' '+level_active+'\'><a data-html="true" data-toggle="tooltip" rel="tooltip" data-placement="left" data-title="<p>'+x_p+'</p>" class="binaryTree" style="display:block"   \'><i class="fa fa-user type-'+node.level+' package-'+node.maxPD+'" onclick=\'click_node('+node.id+')\' value=\''+node.id+'\' aria-hidden="true"></i></a><div class="username_node"><p>'+node.username+'</p></div>' 
        : '<div class=\''+node_class+'\'><a data-toggle="tooltip" data-placement="bottom" style="display:block" onclick=\'click_node_add('+node.p_binary+', "'+positon[1]+'")\' value=\''+node.p_binary+'\' title="Tạo tài khoản"><i class="fa fa-plus-square type-add"></i></a>';

    html += '<div id=\''+node.id+'\' ></div>';

    html += '</div>';

    $(this).append(html);

    node.children && $.each( node.children, function( key, value ) {
       $('#'+node.id).show_tree(value);

        $('[data-toggle="popover"]').popover();
    });



};


jQuery.fn.show_infomation = function(node) {  

  $.getJSON(
      "index.php?route=account/personal/getInfoUser&id="+node,
    function(data){
    $(this).find('dd').html('');      

      if(data.id !=0){

        $.each(data, function (k,v){
        $('#ajax_'+k).html(v);

      });     

      }

    }
  );

};

// xay dung cay voi id truyen vo

jQuery.fn.build_tree = function(id, method) {   

    $('.personal-tree').html('<img src="<?php echo $self -> config -> get('config_ing_loading'); ?>"  />');

    $.ajax({

      url: "index.php?route=account/personal/"+method,

      dataType: 'json',

      data: {id_user : id},

      success: function(json_data){

        var rootnode = json_data[0];
         $('.personal-tree').html('');

         $('.personal-tree').show_tree(rootnode);

         $('.personal_contain').show_infomation(rootnode.id);

         $('#current_top').html("Goto "+rootnode.name + "\'s");

      }

    }); 

};

})(jQuery);
  var click_node_add =  function (p_binary, positon){
    var link = 'adduser.html';
    link += '&id=' + p_binary;
    link += '_'+ positon;
    link += '_'+ '<?php echo $customer_code; ?>';
    location.href = link;
    
  };
   function click_node(id){
    jQuery(document).build_tree(id,'getJsonBinaryTree_Admin');
    $('.tooltip').hide();
    !_.contains(window.arr_lick, id) && window.arr_lick.push(id);
   }
   window.arr_lick = [];
   function click_back(){
      if(window.arr_lick.length === 0){
        click_node(<?php echo intval($idCustomer); ?>);

      }else{
        window.arr_lick = _.initial(window.arr_lick);
        typeof _.last(window.arr_lick) !== 'undefined' ? click_node(_.last(window.arr_lick)) : click_node(<?php echo intval($idCustomer); ?>);
      }
   }

function upto_level(id){

  var top = jQuery('.personal-tree'+id+' > div a').eq(0).attr('value');

  jQuery(document).build_tree(top,'getJsonBinaryTreeUplevel');

}

function goto_bottom_left(id){

  jQuery(document).build_tree(id,'goBottomLeft');

}

function goto_bottom_right(id){

  jQuery(document).build_tree(id,'goBottomRight');

}

function goto_bottom_left_oftop(id){

  var top = jQuery('.personal-tree'+id+' > div a').eq(0).attr('value');

  jQuery(document).build_tree(top,'goBottomLeft');

}

function goto_bottom_right_oftop(id){

  var top = jQuery('.personal-tree'+id+' > div a').eq(0).attr('value');

  jQuery(document).build_tree(top,'goBottomRight');

}

jQuery(document).ready(function($) {
  click_node(<?php echo intval($idCustomer);?>);
  
  function numberWithCommas(x) {
      x = x.toString();
      var pattern = /(-?\d+)(\d{3})/;
      while (pattern.test(x))
          x = x.replace(pattern, "$1,$2");
      return x;
  }
});

</script>

<?php echo $footer; ?>