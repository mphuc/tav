<?php $self -> document -> setTitle($lang['createPD']); echo $self -> load -> controller('common/header'); echo $self -> load -> controller('common/column_left'); ?><div class="wraper container-fluid"> <div class="page-title"> <h3 class="title"><?php echo $lang['createPD'] ?></h3> </div><div class="row"> <div class="col-md-12"> <div class="panel panel-default"> <div class="panel-heading"> <h3 class="panel-title"><?php echo $lang['text_button_create'] ?></h3> </div><div class="panel-body"> <?php if($wallet){?> <div class="row"> <div class="col-md-12"> <div class="alert alert-success alert-edit-account" style="display:none"> <i class="fa fa-check"></i> <?php echo $lang['ok'] ?>. </div><div id="checkPD-error" class="alert alert-dismissable alert-danger" style="display:none"> </div><div id="checkWaiting-error" class="alert alert-dismissable alert-danger" style="background-color: rgba(255, 0, 0, 0.09); display:none"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <form id="submitPD" class="form-horizontal margin-none" name="buy_share_form" action="<?php echo $self -> url -> link('account/pd/submit', '', 'SSL'); ?>" method="post" novalidate="novalidate"> <div class="form-group"> <div class="col-md-6"> <input class="form-control" placeholder="<?php echo $lang['amount'] ?>" id="amount" name="amount" type="text" placeholder="Enter amount"/> <div id="err-c-wallet" class="field-validation-error" style="display:none"> You cannot create Investment, please enter amount to more than 0.5 BTC. </div><span id="amount-error" class="field-validation-error" style="display: none;"> <span ><?php echo $lang['err_amount'] ?>.</span> </span> </div></div><div class="form-group"> <div class="col-md-6"> <input class="form-control" placeholder="<?php echo $lang['password'] ?>" id="Password2" name="Password2" type="password"/> <span id="Password2-error" class="field-validation-error" style="display: none;"> <span >The transaction password field is required.</span> </span> </div></div><div class="control-group form-group"> <div class="controls"> <div class=""> <div class="loading"></div><button type="submit" class="btn-register btn btn-primary"> <?php echo $lang['text_button_create'] ?></button> </div></div></div></div></div><?php }else{ ?> <div class="row"> <div class="col-md-12"> <div class="alert alert-danger"> <strong>Important!</strong> Please add your "bitcoin wallet address to initialize your account. <p style="margin-top:15px;" ><a href="<?php echo $self -> url -> link('account/setting', '', 'SSL'); ?>"><i class="fa fa-cog"></i> Profile</a></p></div><div class="alert alert-warning"> <strong>Note!</strong> "Bitcoin wallet address "use to transfer Bitcoin when you perform transaction" </div></div></div><?php } ?> </div></div></div></div></div><script type="text/javascript">window.err_password='<?php echo $lang['err_password'] ?>';window.err_pd='<?php echo $lang['err_pd'] ?>';window.err_pin='<?php echo $lang['err_pin'] ?>';window.err_account='<?php echo $lang['err_account'] ?>';window.err_password_2='<?php echo $lang['err_password_2'] ?>';</script><?php echo $self->load->controller('common/footer') ?>