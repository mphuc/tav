<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
</head>
<body>
	<div id="content">
		<h2>Code <?php echo number_format($investment) ?> VNĐ</h2>
		<i><p>Thời gian tạo: <?php echo date('d/m/Y H:i:s') ?></p></i>
		<div class="content">
			<table>
				<thead>
					<th>TT</th>
					<th>Code</th>
					<th>Giá tiền</th>
				</thead>
				<tbody>
					<?php $i = 0; foreach ($code as $value) { $i++; ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $value ?></td>
							<td><?php echo number_format($investment) ?> VNĐ</td>
						</tr>	
					<?php } ?>
					
				</tbody>
			</table>
			
		</div>
	</div>
</body>
<!-- <script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.code').html(localStorage.getItem('code'));
		jQuery('.investment').html(localStorage.getItem('investment'));
		jQuery('.username').html(localStorage.getItem('username'));
		jQuery('.phone').html(localStorage.getItem('phone'));
		jQuery('.address').html(localStorage.getItem('address'));

	})
</script> -->
<style type="text/css" media="print">
	@page {
	    size: auto;   /* auto is the initial value */
	    margin: 0;  /* this affects the margin in the printer settings */
	}
</style>
<style type="text/css">
	body{
		width: 1100px;
		margin: 0 auto;
		padding: 70px;
		font-size: 20px;
		padding-top: 50px;
		background: url('../images/logo.png') no-repeat center 140px;
	}
	#content h2{
		text-transform: uppercase;
		text-align: center;
	}
	#content i{
		width: 100%;
	    float: left;
	    text-align: center;
	    margin-top: -15px;
	}
	.content{
		width: 600px;
		margin: 0 auto;
		margin-top:50px;
	}
	.content p{
		width: 100%;
		float: left;
		margin: 0px;
	}
	.content p span{
		font-size: 22px;
		float: left;
		height: 40px;
	}
	.code{
		font-weight: bold;
		font-size: 20px;
	}
	table{
		width: 100%
	}
	table td, table th{
		border:  1px solid #eee;
		text-align: center;
	}
</style>
</html>