<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="SmartBox">


<title>Lock authentication | mackayshieldslife.com</title>

<link rel="icon" href="catalog/view/theme/default/images/logo_icon.png">

<link rel="stylesheet" href="catalog/view/theme/default/assets/plugins/morris/morris.css">
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/core.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/components.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/icons.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/pages.css" type="text/css" />
<link rel="stylesheet" href="catalog/view/theme/default/assets/css/responsive.css" type="text/css" />


<script src="catalog/view/theme/default/assets/js/modernizr.min.js"></script>

</head>

<body class="loreg-page close-it">
<!-- Begin page -->
<div id="logreg-wrapper" class="login-style2 text-center"> 
   <div class="container">
       <a href="#"><img src="catalog/view/theme/default/images/logo.png" style="width: 310px; margin-bottom: 70px;" class="img-responsive center-block" alt=""/></a>
      <p class="lead" style="font-size: 35px;">INPUT YOUR AUTHENTICATOR CODE</p>
   
      <form action="index.php?route=account/lock" method="post">
         <div class="form-group">
            <label>CODE</label>
            
            <input type="text" name="authenticator" value="" placeholder="INPUT YOUR AUTHENTICATOR CODE" class="form-control" id="email">
         </div>
        
         <div class="form-group">
            
            <?php if ($error_warning) { ?>
            <div class="text-warning"><i class="fa fa-exclamation-circle"></i>
               <?php echo $error_warning; ?>
            </div>
            <?php } ?>
         </div>
         <button type="submit" class="btn btn-success btn-md">Login</button>
      </form>
      
      <p class="copy">&copy; 2017. Mackayshieldslife<span>Com</span></p>
   </div>
</div>
<!-- END wrapper --> 

<!-- Page Loader --> 
<div class="page-loader">
   <a href="#"><img src="catalog/view/theme/default/assets/images/logo-2.png" class="img-responsive center-block" alt=""/></a>
   <span class="text-uppercase">Loading...</span>
</div>

<!-- SmartBox Js files --> 
<script>
       var resizefunc = [];
</script> 

<script src="catalog/view/theme/default/assets/js/jquery.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/bootstrap.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/pace.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/loader.js"></script> 
<script src="catalog/view/theme/default/assets/js/detect.js"></script> 
<script src="catalog/view/theme/default/assets/js/fastclick.js"></script> 
<script src="catalog/view/theme/default/assets/js/waves.js"></script> 
<script src="catalog/view/theme/default/assets/js/wow.min.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.slimscroll.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.nicescroll.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.scrollTo.min.js"></script> 
<script src="catalog/view/theme/default/assets/pages/jquery.todo.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/moment/moment.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/morris/morris.min.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/raphael/raphael-min.js"></script> 
<script src="catalog/view/theme/default/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script> 
<script src="catalog/view/theme/default/assets/pages/jquery.charts-sparkline.js"></script> 
<script type="text/javascript" src="../../../www.gstatic.com/charts/loader.js"></script> 
<script src="catalog/view/theme/default/assets/js/jquery.app.js"></script> 
<script src="catalog/view/theme/default/assets/js/cb-chart.js"></script> 
<script src="catalog/view/javascript/alertifyjs/alertify.js" type="text/javascript"></script>
<link href="catalog/view/theme/default/css/al_css/alertify.css" rel="stylesheet">
</body>
</html>


<script type="text/javascript">
   if (location.hash === '#success') {
      alertify.set('notifier','delay', 100000000000);
      alertify.set('notifier','position', 'top-right');
      alertify.success('Activation successful!');
   }
   
</script>