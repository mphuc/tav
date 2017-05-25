<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo $title; ?> </title>
      <meta http-equiv="cache-control" content="no-cache"/>
      <base href="<?php echo $base; ?>"/>
      <?php if ($description){ ?>
      <meta name="description" content="<?php echo $description; ?>"/>
      <?php } ?><?php if ($keywords){ ?>
      <meta name="keywords" content="<?php echo $keywords; ?>"/>
      <?php } ?>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="icon" href="catalog/view/theme/default/images/logo_icon.png">
      
      <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
      
      <script src="catalog/view/javascript/bootstrap.min.js"></script>
    
      <!---  -->
      <link href="favicon.png" rel="shortcut icon">
      <link href="apple-touch-icon.png" rel="apple-touch-icon">
      
      <link href="catalog/view/theme/default/assets/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
      
      <link href="catalog/view/theme/default/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/datatables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/css/main.css" rel="stylesheet">
      <link href="catalog/view/theme/default/assets/css/bootstrap.min.css" rel="stylesheet">

      <!---  -->  
      
      
      <link href="catalog/view/theme/default/css/customer.css" rel="stylesheet">
      <?php foreach ($styles as $style) { ?>
      <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
      <?php } ?>
      <script src="catalog/view/javascript/common.js" type="text/javascript"></script>
      <script type="text/javascript" src="catalog/view/javascript/jquery.simplyscroll.js"></script>
      <?php foreach ($scripts as $script) { ?>
      <script src="<?php echo $script; ?>" type="text/javascript"></script>
      <?php } ?>
      <?php echo $google_analytics; ?>
      <script type="text/javascript"> 
        window.funLazyLoad = {
            start: function() {
                $('.page-loader').show();
            },
            reset: function() {
                $('.page-loader').hide();
            },
            show: function() {
                $('.page-loader').show();
            }
        };
        
      </script>
      <script src="catalog/view/javascript/jquery.form.min.js" type="text/javascript"></script><script src="catalog/view/javascript/alertifyjs/alertify.js" type="text/javascript"></script>
      <link href="catalog/view/theme/default/css/al_css/alertify.css" rel="stylesheet">
      <script src="catalog/view/javascript/changeLang.js" type="text/javascript"></script><script type="text/javascript" src="catalog/view/javascript/bxslider/jquery.bxslider.js"></script>
    
   </head>
<body>
  <div class="all-wrapper">
    <div class="layout-w">
                                  
                                  