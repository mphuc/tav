<?php
class ControllerAccountPersonal extends Controller {
	private $error = array();

	public function index() {
		if (!$this -> customer -> isLogged()) {
			$this -> session -> data['redirect'] = HTTPS_SERVER . 'genealogy.html';

			$this -> response -> redirect(HTTPS_SERVER . 'login');
		}
		$this->document->addScript('catalog/view/javascript/personal/tree.min.js');
		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}

		$data['base'] = $server;

		$this -> load -> language('account/personal');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/personal');
		$data['lang'] = $language -> data;

		$this -> document -> setTitle('Đội nhóm của bạn');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array('text' => $this -> language -> get('text_home'), 'href' => $this -> url -> link('common/home'));

		$data['breadcrumbs'][] = array('text' => $this -> language -> get('heading_title'), 'href' => $this -> url -> link('account/personal', '', 'SSL'));

		$data['heading_title'] = $this -> language -> get('heading_title');

		$data['column_left'] = $this -> load -> controller('common/column_left');
		$data['column_right'] = $this -> load -> controller('common/column_right');
		$data['content_top'] = $this -> load -> controller('common/content_top');
		$data['content_bottom'] = $this -> load -> controller('common/content_bottom');
		$data['footer'] = $this -> load -> controller('common/footer');
		$data['header'] = $this -> load -> controller('common/header');
		$data['idCustomer'] = $this -> customer -> getId();

		$this -> load -> model('account/customer');
		$id_user = $data['idCustomer'];
		$user = $this -> model_account_customer -> getCustomer($id_user);

		$data['nameCustomer'] = $this -> customer -> getFirstname();
		$data['telephone'] = $this -> customer -> getTelephone();
		$data['total_left'] = $this -> model_account_customer -> getSumLeft($id_user);
		$data['total_right'] = $this -> model_account_customer -> getSumRight($id_user);
		$data['floor'] = $this -> model_account_customer -> getSumFloor($id_user);
		$data['total'] = $data['total_left'] + $data['total_right'];
		$data['self'] = $this ;
		$data['register_link'] = HTTPS_SERVER.'register';
		//=============================Refferal=======================
		$customer = $this -> model_account_customer-> getCustomer($this -> session -> data['customer_id']);

		$Hash = $customer['customer_code'];	
		
		$data['customer_code'] = $Hash;

		$customer = $customer['username'];	
		$data['username'] = $customer;

		
		$customer = null;

		$data['customerChild'] = $this -> model_account_customer-> getParentByIdCustomer($this -> session -> data['customer_id']);
		
		$total = $this -> model_account_customer-> getCountTreeCustom($this -> session -> data['customer_id']);
		$data['user'] = $this -> model_account_customer -> get_count_customer_signup($this->session->data['customer_id']);
		$data['trees'] =  HTTPS_SERVER . 'index.php?route=account/personal/get_BinaryTree';
		//==============================================================

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/personal.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/personal.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/personal.tpl', $data));
		}
	}
	public function get_BinaryTree(){

		$this -> load -> model('account/customer');
		
		// $id = $this->request->get['id_user'];
		$id = $this->session->data['customer_id'];

		$user = $this -> model_account_customer -> getInfoUsers_binary($id);



		$node = new stdClass();


		$node->id = $id;
		
		// $node->text = $user['username'] ;

		$node->username = $user['username'] ;
		// $node -> email = $user['email'];
		// $node -> telephone = $user['telephone'];
		// $node -> date_added = $user['date_added'];
		$node -> level = $user['level'];
		// $node-> level_user = $user["level_member"];
		switch (intval($user['level'])) {
			case '1':
				$type = 'darkturquoise';
				break;
			
			case '2':
				$type = 'darkturquoise';
				break;
			default:
				$type = 'darkturquoise';
				break;
			
		}
		$node-> type = $type;
		// $node -> status_ml = $user['status_ml'];
		

		$date = strtotime(date('Y-m-d'));
		$monthNow = date('m',$date);
		$yearNow = date('Y',$date);
		$date_added = strtotime($user['date_added']);
		$month = date('m',$date_added);
		$year = date('Y',$date_added);
		
		// if($user['status'] == 0){
		// 	$node->iconCls = "level4";
		// }else if($monthNow == $month && $yearNow == $year){
		// 	$node->iconCls = "level2";
		// }else{
		// 	$node->iconCls = "level3";
		// }

		$node->fl = 1;

		$this->get_BinaryChildTree($node);

		$node = array($node);

	//	ob_clean();
		echo json_encode($node[0]);

		exit();

	}
	public function get_BinaryChildTree(&$node){

		$date = strtotime(date('Y-m-d'));
		$monthNow = date('m',$date);
		$yearNow = date('Y',$date);
		
		$this -> load -> model('account/customer');
		$left_row = $this -> model_account_customer ->getLeftO($node->id);
		
		// print_r($left_row);
		// die();
			$left = new stdClass();
		
		    foreach ($left_row as $key => $value) {
		        $left->$key = $value;
		    } 
			
			$node->children = array();

			if(isset($left_row["id"])){

				$left->fl = $node->fl +1;
				$left -> position ='left';
				$lv = $node->level;
// switch (intval($lv)) {
// 			case '1':
// 				$type = 'darkturquoise';
// 				break;
			
// 			case '2':
// 				$type = 'red';
// 				break;
// 			default:
// 				$type = 'blue';
// 				break;
			
// 		}
		$left-> type = 'darkturquoise';
				$left -> empty = false;
				
					$this->get_BinaryChildTree($left);
				
				
				array_push($node->children , $left);			

			}
		

		$right_row = $this -> model_account_customer ->getRightO($node->id);
		$right = new stdClass();
	    foreach ($right_row as $key => $value) {
	        $right->$key = $value;
	    } 
		
		if(isset($right_row["id"])){

			$right->fl = $node->fl +1;
			$right -> position ='right';
$lv = $node->level;
// switch (intval($lv)) {
// 			case '1':
// 				$type = 'darkturquoise';
// 				break;
			
// 			case '2':
// 				$type = 'red';
// 				break;
// 			default:
// 				$type = 'blue';
// 				break;
			
// 		}
		$right-> type = 'darkturquoise';

			$right -> empty = false;
			
				$this->get_BinaryChildTree($right);

			

			array_push($node->children , $right);
		}
		

		if(count($node->children) ==0) $node->children = 0;

		return;

	}

	public function checkBinaryLeft($p_binary, $postion){

		$this -> load -> model('account/customer');
		if ($postion=='left') {
			$Binary = $this -> model_account_customer -> checkBinaryLeft($p_binary);

			if (!empty($Binary)) {
				$checkLeft = intval($Binary['left']);

				return $checkLeft === 0 ? 1 : 2;
				
			}
			else{
				return 1;
			}
				
				//return $checkLeft = 1;			
		}
		if ($postion=='right') {
			$Binary = $this -> model_account_customer -> checkBinaryRight($p_binary);	
			if (!empty($Binary)) {
				$checkRight = intval($Binary['right']);

			 	return $checkRight === 0 ? 1 : 2;
			} else {
				return 1;
			}
		}
		
	}
	public function checkBinaryRight($p_binary){
		$this -> load -> model('account/customer');
		$Binary = $this -> model_account_customer -> checkBinaryRight($p_binary);
		$CountBinary = count($Binary);
		if ($CountBinary > 0) {
			$checkRight = intval($Binary['right']);
		return $checkRight === 0 ? 1 : 2;
		}
		
	}
public function checkBinary($p_binary){
		$this -> load -> model('account/customer');
		$binary = $this -> model_account_customer -> checkBinary($p_binary);
		$checkbinary = count($binary);
		return $checkbinary === 0 ? 2 : 1;
	}
	public function add_customer (){

			$this -> load -> model('account/customer');
			$this -> document -> addScript('catalog/view/javascript/register/register.js');
		
		! array_key_exists('id', $this -> request -> get) && $this -> response -> redirect($this -> url -> link('/login.html'));
		
		$token = explode("_", $this -> request -> get['id']);
		
		$p_binary = $token[0]; 
		if (!is_numeric($p_binary)) $this -> response -> redirect($this -> url -> link('/login.html'));
		$postion = $token[1];
		$code= $token[2];
		if($postion === 'right' || $postion === 'left'){

		}else{
			$this -> response -> redirect(HTTPS_SERVER . 'login');
		}
		try {	
			$customer = $this -> model_account_customer -> getCustomer($p_binary);
			!$customer && $this -> response -> redirect(HTTPS_SERVER . 'login');
			
			$data['customercode'] = $customercode = $this -> model_account_customer -> getCustomerbyCode($code);
			!$customercode && $this -> response -> redirect(HTTPS_SERVER . 'login');
			
		} catch (Exception $e) {
			$this -> response -> redirect(HTTPS_SERVER . 'login');
		}


		//start load country model
		$this -> load -> model('customize/country');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;

		$data['country'] = $this -> model_customize_country -> getCountry();
		//end load country model

		//data render website
		$data['self'] = $this;

		//error validate
		$data['error'] = $this -> error;
		$data['p_binary'] = $token[0];
		$data['postion'] = $token[1];
		$data['country'] = $this -> model_customize_country -> getCountry();
		$data['action'] = $this -> url -> link('account/registers/confirmSubmit', 'token=' . $token[2], 'SSL');
		$data['actionCheckUser'] = $this -> url -> link('account/registers/checkuser', '', 'SSL');
		$data['actionWallet'] = $this -> url -> link('account/personal/checkwallet', '', 'SSL');
		$data['actionCheckEmail'] = $this -> url -> link('account/registers/checkemail', '', 'SSL');
		$data['actionCheckPhone'] = $this -> url -> link('account/registers/checkphone', '', 'SSL');
		$data['actionCheckCmnd'] = $this -> url -> link('account/registers/checkcmnd', '', 'SSL');
		// $data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this -> load -> controller('common/footer');
		$data['header'] = $this -> load -> controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/registers.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/registers.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/registers.tpl', $data));
		}

	}

	public function register_submit(){
		
		
		if ($this->request->server['REQUEST_METHOD'] === 'POST'){
			$this -> load -> model('customize/register');
			$this -> load -> model('account/auto');
			$this -> load -> model('account/customer');

			$check_p_binary = $this -> model_account_customer -> check_p_binary($this->request->post['p_binary']);
			
			if (intval($check_p_binary['number']) === 2) {
				die('Error');
			}else{
				$get_customer_Id_by_username = $this -> model_account_customer-> get_customer_Id_by_username($_POST['username']);
				count($get_customer_Id_by_username) > 0 && die();

				$transaction_password = $this->request->post['transaction_password'] = rand(100000,999999);

				$tmp = $this -> model_customize_register -> addCustomer_custom($this->request->post);

				$cus_id= $tmp;

				$code_active = sha1(md5(md5($cus_id)));

				$this -> model_customize_register -> insert_code_active($cus_id, $code_active);

				$amount = 0;

				$checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($cus_id);
				if(intval($checkM_Wallet['number'])  === 0){
					if(!$this -> model_account_customer -> insert_M_Wallet($amount, $cus_id)){
						die();
					}
				}

				

				
				
				
				$data['has_register'] = true;
				
				// send mail
				

				
				
				$html_mail = '<div style="background: #f2f2f2; width:100%;">
				   <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
				    width:700px; margin:0 auto">
				   <tbody>
				      <tr>
				        <td>
				          <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'catalog/view/theme/default/img/logo.png" alt="logo" style="margin: 30px auto; width:150px;"></div>
				        </td>
				       </tr>
				       <tr>
				       <td style="border: 1px solid #dbdbdb;background-color: #ffffff;border-radius: 5px; padding: 10px; width: 600px; margin: auto; font-family: Arial,Helvetica,sans-serif; font-size: 14px; margin-top:25px; padding:30px;">
				       	<div style="font-size:14px;font-weight:bold; margin-top:25px; margin-bottom:30px;">Xin chào <span style="color:#01aeef">'.$this-> request ->post['username'].'</span></div>
				       	<h2>Lời chào từ <span style="color:#01aeef"> Tâm An Việt! </span></h2>

				       	<p>Cám ơn bạn đã đăng ký tài khoản tại Tâm An Việt</p>

				       	<table width="70%" cellspacing="0" cellpadding="4" align="center" border="1" rules="all">
							   <tbody>
							      <tr>
							         <td colspan="3" align="center" bgcolor="#fff"><span style="font-size:16px"><strong>Chi tiết tài khoản</strong></span></td>
							      </tr>
							      <tr>
							         <td width="50%" align="right">Tên đăng nhập</td>
							         
							         <td width="47%"><b>'.$this-> request ->post['username'].'</b></td>
							      </tr>
							      <tr>
							         <td align="right">Số điện thoại</td>
							        
							         <td><b>'.$this-> request ->post['telephone'].'</b></td>
							      </tr>
							      <tr>
							         <td align="right">Mật khẩu </td>
							        
							         <td><b>'.$this-> request ->post['password'].'</b></td>
							      </tr>
							      <tr>
							         <td align="right">Ngân hàng</td>
							        
							         <td><b>'.$this-> request ->post['bank_name'].'</b></td>
							      </tr>
							      <tr>
							         <td align="right">Tên tài khoản</td>
							        
							         <td><b>'.$this-> request ->post['account_hodder'].'</b></td>
							      </tr>

							      <tr>
							         <td align="right">Số tài khoản</td>
							        
							         <td><b>'.$this-> request ->post['account_number'].'</b></td>
							      </tr>

							      

							   </tbody>
							</table>
							<p style="margin-bottom:10px; line-height:25px;">This is an auto generated password. You are advised to change your password as per your convenience.</p>
							<p style="margin-bottom:10px; line-height:25px;">
								Chúng tôi cảm ơn bạn vì đã quan tâm đến việc mở Tài khoản Tâm An Việt. Xin vui lòng liên hệ với chúng tôi để được trợ giúp.
							</p>
							
							<p style="margin-bottom:10px; line-height:25px;">
								Trân trọng
							</p>
							<p style="margin-bottom:10px; line-height:25px;">
								Tâm An Việt
							</p>
	   	
				       </tr>
				    </tbody>
				    </table>
				  </div>';
					
				//print_r($html_mail);die;

				$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, TOKEN_STORAGE );
			    $email = array(
			        'html' => $html_mail,
			        'text' => 'text',
			        'subject' => 'Tâm An Việt',
			        'from' => array(
			            'name' => 'Tâm An Việt',
			            'email' => 'administrator@tamanviet.net'
			        ),
			        'to' => array(
			            array(
			                'name' => 'Tâm An Việt',
			                'email' => $_POST['email']
			            )
			        )
			    );
			    if($SPApiProxy->smtpSendMail($email)->result)
			    {
			    	//echo "thanhcong";
			    }

				$this-> model_customize_register -> update_template_mail($code_active, $html_mail);
				$mail -> setHtml($html_mail);
				//$mail -> send();
				//print_r($mail);die;
				
				$this -> session -> data['fullname'] = $this-> request ->post['username'];
				$this->session->data['register_mail'] = $this-> request ->post['email'];
				unset($_SESSION['customer_id']);
				$this -> response -> redirect(HTTPS_SERVER . 'login.html#success');
			}
			
		}

	}

	public function create_wallet_blockio($lable){
		$block_io = new BlockIo(key, pin, block_version);
		$wallet = $block_io->get_new_address(array('label' => $lable));
		return $wallet->data->address;
	}

	public function get_address_balance($address){
		$block_io = new BlockIo(key, pin, block_version);
		$balances = $block_io->get_address_balance(array('addresses' => $address));
		$balances['available_balance'] = $balances->data->available_balance;
		$balances['pending_received_balance'] = $balances->data->pending_received_balance;
		return $balances;
	}

	public function create_wallet_coinmax($customercode) {
		$length = 33;
		$str ="";
		$secret = substr(hash_hmac('sha1', hexdec(crc32(md5($customercode))), 'secret'), 0, 100);
		$chars = $secret."ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
		 }
		return '7'.$str;
	}

	public function update_create_wallet(){
		$this -> load -> model('account/customer');
		
		$getall_user = $this -> model_account_customer ->getall_user_customer();
		foreach ($getall_user as $value) {

			//echo substr($value['customer_code'], 6); die;
			
			
			// check wallet block io
			$check_wallet_blockio = $this -> model_account_customer -> check_wallet_blockio($value['customer_id']);
			if ($check_wallet_blockio == 0)
			{
				$label = $value['customer_id']."-".rand(10,100);
				$wallet_blockio = $this -> create_wallet_blockio($label);
				$this -> model_account_customer ->insert_wallet_blockio(0, $value['customer_id'],$wallet_blockio,$label);
			}
			// check wallet coinmax
			$check_wallet_coinmax = $this -> model_account_customer -> check_wallet_coinmax($value['customer_id']);

			if ($check_wallet_coinmax == 0)
			{
				$wallet_coinmax = $this -> create_wallet_coinmax($value['customer_code']);
				$this -> model_account_customer ->insert_wallet_coinmax(0, $value['customer_id'],$wallet_coinmax);
			}
			
		}
	}

	public function signup (){

			$this -> load -> model('account/customer');
			$this -> document -> addScript('catalog/view/javascript/register/register.js');
		//language
		
	
		//method to call function
		
		
		$p_binary = 1;
		$postion = 'left';
		$code= '146333582723';
		if($postion === 'right' || $postion === 'left'){

		}else{
			$this -> response -> redirect(HTTPS_SERVER . 'login');
		}
		try {	
			$customer = $this -> model_account_customer -> getCustomer($p_binary);
			!$customer && $this -> response -> redirect(HTTPS_SERVER . 'login');
			
			$customercode = $this -> model_account_customer -> getCustomerbyCode($code);
			!$customercode && $this -> response -> redirect(HTTPS_SERVER . 'login');
			
		} catch (Exception $e) {
			$this -> response -> redirect(HTTPS_SERVER . 'login');
		}


		//start load country model
		$this -> load -> model('customize/country');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;

		$data['country'] = $this -> model_customize_country -> getCountry();
		//end load country model

		//data render website
		$data['self'] = $this;

		//error validate
		$data['error'] = $this -> error;
		$data['p_binary'] = $p_binary;
		$data['postion'] = 'left';
		$data['country'] = $this -> model_customize_country -> getCountry();
		$data['action'] = $this -> url -> link('account/registers/confirmSubmit', 'token=146333582723', 'SSL');
		$data['actionCheckUser'] = $this -> url -> link('account/registers/checkuser', '', 'SSL');
		$data['actionWallet'] = $this -> url -> link('account/personal/checkwallet', '', 'SSL');
		$data['actionCheckEmail'] = $this -> url -> link('account/registers/checkemail', '', 'SSL');
		$data['actionCheckPhone'] = $this -> url -> link('account/registers/checkphone', '', 'SSL');
		$data['actionCheckCmnd'] = $this -> url -> link('account/registers/checkcmnd', '', 'SSL');
		// $data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this -> load -> controller('common/footer');
		$data['header'] = $this -> load -> controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/signup.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/signup.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/signup.tpl', $data));
		}

	}

	public function signup_submit(){
		
		//method to call function
		// !call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		die();
		if ($this->request->server['REQUEST_METHOD'] === 'POST'){
			$this -> load -> model('customize/register');
			$this -> load -> model('account/auto');
			$this -> load -> model('account/customer');

	
				$tmp = $this -> model_customize_register -> signup_custom($this->request->post);

				$cus_id= $tmp;
				$amount = 0;
				$code_active = sha1(md5(md5($cus_id)));
				$this -> model_customize_register -> insert_code_active($cus_id, $code_active);
				$checkC_Wallet = $this -> model_account_customer -> checkR_Wallet($cus_id);
				if(intval($checkC_Wallet['number'])  === 0){
					if(!$this -> model_account_customer -> insertR_WalletR($amount, $cus_id)){
						die();
					}
				}
				$data['has_register'] = true;
				$mail = new Mail();
				$mail -> protocol = $this -> config -> get('config_mail_protocol');
				$mail -> parameter = $this -> config -> get('config_mail_parameter');
				$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
				$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
				$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
				$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

				//$mail -> setTo($this -> config -> get('config_email'));
				$mail -> setTo($_POST['email']);
				$mail -> setFrom($this -> config -> get('config_email'));
				$mail -> setSender(html_entity_decode("Coinmax, Inc", ENT_QUOTES, 'UTF-8'));
				$mail -> setSubject("Congratulations Your Registration is Confirmed!");
				$html_mail ='<div style="background: #f2f2f2; width:100%;">
				   <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#364150;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
				    width:700px; margin:0 auto">
				   <tbody>
				      <tr>
				        <td>
				          <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'/catalog/view/theme/default/img/logo.png" alt="logo" style="margin: 0 auto; width:150px;"></div>
				        </td>
				       </tr>
				       <tr>
				       <td style="background:#fff">
				       	<p class="text-center" style="font-size:20px;color: black;text-transform: uppercase; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;">congratulations !<p>
				       	<p class="text-center" style="color: black; width:100%; float:left;text-align: center;line-height: 15px;margin-bottom:30px;">You have successfully registered account</p>
       	<div style="width:600px; margin:0 auto; font-size=15px">

					       	<p style="font-size:14px;color: black;margin-left: 70px;">Your Username: <b>'.$this-> request ->post['username'].'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Email Address: <b>'.$this-> request ->post['email'].'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Phone Number: <b>'.$this-> request ->post['telephone'].'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Citizenship Card/Passport No: <b>'.$this-> request ->post['cmnd'].'</b></p>
					      
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Password For Login: <b>'.$this-> request ->post['password'].'</b></p>
					       	
					       				       	<p style="font-size:14px;color: black;text-align:center;"><a href="'.HTTPS_SERVER.'active.html&token='.$code_active.'" style="margin: 0 auto;width: 200px;background: #d14836;    text-transform: uppercase;
    border-radius: 5px;
    font-weight: bold;text-decoration:none;color:#f8f9fb;display:block;padding:12px 10px 10px">Active</a></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Bitcoin Wallet: <b>'.$this-> request ->post['wallet'].'</b>	</p>
					       	<p style="text-align:center;">
					       		<img style="margin:0 auto" src="https://chart.googleapis.com/chart?chs=150x150&chld=L|1&cht=qr&chl=bitcoin:'.$this-> request ->post['wallet'].'"/>
					       	</p>
		
					       
		
					          </div>
				       </td>
				       </tr>
				    </tbody>
				    </table>
				  </div>';
				$mail -> setHtml($html_mail); 
				$this -> session -> data['fullname'] = $this-> request ->post['username'];
				unset($this -> session -> data['customer_id']);
				$mail -> send();

				$this-> model_customize_register -> update_template_mail($code_active, $html_mail);
					$this->session->data['register_mail'] = $this-> request ->post['email'];
				$this -> response -> redirect(HTTPS_SERVER . 'signup-success.html#success');
			
			
		}

	}
	public function getInfoUser(){

		$id = $this->request->get['id'];
		
		$this -> load -> model('account/customer');

		$user = $this -> model_account_customer -> getInfoUsers_binary($id);

		$user['total_left'] =  $this -> model_account_customer ->  getSumLeft($id);	

		$user['total_right'] =  $this -> model_account_customer ->  getSumRight($id);
		
		$user['floor'] =  $this -> model_account_customer -> getSumFloor($id);
		
		$user['total'] = $user['total_left'] + $user['total_right'];

		echo json_encode($user);

		exit();

	}

	public function getInfoCustomer() {
		$id_user = $this -> request -> get['id_user'];

		$this -> load -> model('account/customer');

		$user = $this -> model_account_customer -> getCustomer($id_user);
		$json = array();
		$json['nameCustomer'] = $user['firstname'];
		$json['telephone'] = $user['telephone'];
		$json['total_left'] = $this -> model_account_customer -> getSumLeft($id_user);
		$json['total_right'] = $this -> model_account_customer -> getSumRight($id_user);
		$json['floor'] = $this -> model_account_customer -> getSumFloor($id_user);
		$json['total'] = $json['total_left'] + $json['total_right'];
		$this -> response -> addHeader('Content-Type: application/json');
		$this -> response -> setOutput(json_encode($json));
		
	}

	public function getJsonBinaryTree_Admin($id=0){

		$this -> load -> model('account/customer');
		
		$id = $this->request->get['id_user'];

		$user = $this -> model_account_customer -> getInfoUsers_binary($id);
		
		$node = new stdClass();


		$node->id = $id;
		
		$node->text = $user['username'] ;

		$node->username = $user['username'] ;
		$node -> email = $user['email'];
		$node -> telephone = $user['telephone'];
		$node -> date_added = date('d-F-Y H:i A',strtotime($user['date_added']));
		$node -> level = $user['level'];
		$node -> level_user = $user["level_member"];
		$node -> firstname = $user["firstname"];

		if ($this -> total_pd_left($id) < $this -> total_pd_right($id))
		{
			$nhanhyeu = $this -> total_pd_left($id);
		}
		else
		{
			$nhanhyeu = $this -> total_pd_right($id);
		}
		$node -> PDnhanhyeu = $nhanhyeu;

		
		$node -> totalPD = $this -> total_pd($id);
		$node -> maxPD = $this -> max_pd($id);
		$node -> sponsor = $this -> sponsor($user['p_node']);
		$node -> numberf1 = $this -> numberf1($id);
		$node -> img_profile = $this -> img_profile($id);
		$node -> empty = false;
		
		$date = strtotime(date('Y-m-d'));
		$monthNow = date('m',$date);
		$yearNow = date('Y',$date);
		$date_added = strtotime($user['date_added']);
		$month = date('m',$date_added);
		$year = date('Y',$date_added);
		
		if($user['status'] == 0){
			$node->iconCls = "level4";
		}else if($monthNow == $month && $yearNow == $year){
			$node->iconCls = "level2";
		}else{
			$node->iconCls = "level3";
		}

		$node->fl = 1;

		$this->getBinaryChild_binary($node);

		$node = array($node);

	//	ob_clean();
		echo json_encode($node);

		exit();

	}
	
	function total_pd_left($customer_id){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($customer_id);
		$count = number_format($count['total_pd_left']);

		return $count;
		// $left_id = $count['left'];
		// if(intval($count['left']) === 0){
		// 	$total = 0;
		// }else{
		// 	$count = $this -> model_account_customer -> getCount_ID_BinaryTreeCustom($count['left']);

		// 	$count = substr($count, 1);
		// 	$total = $this -> model_account_customer -> countPDLeft_Right($count);
		// 	$total = doubleval($total['total']);

		// 	$customer = $this -> model_account_customer -> getCustomer($left_id);
		// 	$total += doubleval($customer['total_pd']);

		// 	$total = $total / 100000000;
		// }

		// return $total;

	}
	public function total_pd($customer_id){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getTotalPD($customer_id);
		$count = number_format($count['number'] / 10000);

		return $count;
	}
	public function sponsor($customer_id){
		if ($customer_id == 0)
		{
			return "Null";
		}
		else
		{
			$this -> load -> model('account/customer');
			$count = $this -> model_account_customer ->  getCustomer($customer_id);
			return $count['username'];
		}
	}

	public function numberf1($customer_id)
	{
		return $this -> model_account_customer -> numberf1($customer_id);
	}

	public function max_pd($customer_id){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getmax_PD($customer_id);
		$count = number_format($count['number'] / 10000);
		switch (doubleval($count)) {
			case 100:
				$package = 100;
				break;
			case 500:
				$package = 500;
				break;
			case 1000:
				$package = 1000;
				break;
			case 2000:
				$package = 2000;
				break;
			case 5000:
				$package = 5000;
				break;
			case 10000:
				$package = 10000;
				break;
			case 50000:
				$package = 50000;
				break;
			case 100000:
				$package = 100000;
				break;
			case 200000:
				$package = 200000;
				break;
			default:
				$package = 0;
				break;
		}

		return $package;
	}
	public function total_pd_right($customer_id){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($customer_id);

		$count = number_format($count['total_pd_right']);
		return $count;
		// $left_id = $count['right'];
		// if(intval($count['right']) === 0){
		// 	$total = 0;
		// }else{
		// 	$count = $this -> model_account_customer -> getCount_ID_BinaryTreeCustom($count['right']);

		// 	$count = substr($count, 1);

		// 	$total = $this -> model_account_customer -> countPDLeft_Right($count);
		// 	$total = doubleval($total['total']);

		// 	$customer = $this -> model_account_customer -> getCustomer($left_id);
		// 	$total += doubleval($customer['total_pd']);
			
		// 	$total = $total / 100000000;

		// }

		// return $total;

	}

	public function getBinaryChild_binary(&$node){

		$date = strtotime(date('Y-m-d'));
		$monthNow = date('m',$date);
		$yearNow = date('Y',$date);
		
		$this -> load -> model('account/customer');
		$left_row = $this -> model_account_customer ->getLeftO($node->id);
		
		// print_r($left_row);
		// die();
			$left = new stdClass();
		
		    foreach ($left_row as $key => $value) {
		        $left->$key = $value;
		    } 
			

			$node->children = array();

			if(isset($left_row["id"])){

				$left->fl = $node->fl +1;
				$left -> empty = false;

				

				if($left->fl<5){
					if ($this -> total_pd_left($left->id) < $this -> total_pd_right($left->id))
					{
						$nhanhyeu = $this -> total_pd_left($left->id);
					}
					else
					{
						$nhanhyeu = $this -> total_pd_right($left->id);
					}
					
					$left -> PDnhanhyeu = $nhanhyeu;
					
					$left -> totalPD = $this -> total_pd($left->id);
					$left -> maxPD = $this -> max_pd($left->id);
					$left -> sponsor = $this -> sponsor($left_row['p_node']);
					$left -> firstname = $left_row["firstname"];
					$left -> date_added = date('d-F-Y H:i A',strtotime($left_row['date_added']));
					$left -> numberf1 = $this -> numberf1($left->id);
					$left -> img_profile = $this -> img_profile($left->id);
					$left -> level = $left_row['level'];
					$this->getBinaryChild_binary($left);
				}


				else $left->children = 1;
				
				array_push($node->children , $left);			

			}else{
				$left->fl = $node->fl +1;
				$left -> p_binary = $node -> id;
				$left -> empty = true;
				$left -> iconCls = 'level1 left';
				$left -> id =  "-1";
				array_push($node->children , $left);
			}
		

		$right_row = $this -> model_account_customer ->getRightO($node->id);
		$right = new stdClass();
	    foreach ($right_row as $key => $value) {
	        $right->$key = $value;
	    } 
		
		if(isset($right_row["id"])){

			$right->fl = $node->fl +1;

			$right -> empty = false;
			if($right->fl<5){
				if ($this -> total_pd_left($right->id) < $this -> total_pd_right($right->id))
				{
					$nhanhyeu = $this -> total_pd_left($right->id);
				}
				else
				{
					$nhanhyeu = $this -> total_pd_right($right->id);
				}
				
				$right -> PDnhanhyeu = $nhanhyeu;
				
				$right -> totalPD = $this -> total_pd($right->id);
				$right -> maxPD = $this -> max_pd($right->id);
				$right -> sponsor = $this -> sponsor($right_row['p_node']);
				$right -> firstname = $right_row["firstname"];
				$right -> date_added = date('d-F-Y H:i A',strtotime($right_row['date_added']));
				$right -> numberf1 = $this -> numberf1($right->id);
				$right -> img_profile = $this -> img_profile($right->id);
				$right -> level = $right_row['level'];
				$this->getBinaryChild_binary($right);
			}
			else $right->children = 1;

			array_push($node->children , $right);
		}else{
			$right->fl = $node->fl +1;
			$right -> empty = true;
			$right -> p_binary = $node -> id;
			$right -> iconCls = 'level1 right';
			$right -> id =  -1;
			array_push($node->children , $right);
		}
		

		if(count($node->children) ==0) $node->children = 0;

		return;

	}

	public function getJsonBinaryTree() {

		$id_user = $this -> request -> get['id_user'];

		$this -> load -> model('account/customer');

		$user = $this -> model_account_customer -> getCustomerCustom($id_user);

		$node = new stdClass();

		$node -> id = $user['customer_id'];

		$node -> text = $user['username'] ;

		$node -> iconCls = intval($user['level']) === 1 ? "level1" : "level2";
		

		$this -> getBinaryChild($node);

		$node = array($node);


		echo json_encode($node);

		exit();

	}

	public function getBinaryChild(&$node) {

		$this -> load -> model('account/customer');

		$listChild = $this -> model_account_customer -> getListChild($node -> id);

		$node -> children = array();

		foreach ($listChild as $child) {
			$childNode = new stdClass();

			$childNode -> id = $child['customer_id'];

			$childNode -> text = $child['username'];

			$childNode -> iconCls = intval($child['level']) === 1 ? "level1" : "level2";
			array_push($node -> children, $childNode);

			$this -> getBinaryChild($childNode);

		}
		if (count($node -> children) === 0)
			$node -> children = 0;
		return;

	}

	public function img_profile($customer_id)
	{
		$getCustomer = $this -> model_account_customer -> getCustomer($customer_id);
		if ($getCustomer['img_profile'] == "")
		{
			$img = "catalog/view/theme/default/images/logo.png";
		}
		else
		{
			$img = $getCustomer['img_profile'];
		}
		return $img;
	}

	public function checkwallet() {
		if ($this -> request -> get['wallet']) {
			$this -> load -> model('customize/register');
			$validate_address = $this -> check_address_btc($this -> request -> get['wallet']);
			$jsonwallet = $this -> model_customize_register -> checkExitWalletBTC($this -> request -> get['wallet']);
			if (intval($validate_address) === 1 && intval($jsonwallet) != 1000)   {
				$json['wallet'] = 0;
			} else {
				$json['wallet'] = -1;
			}
			
			
			$this -> response -> setOutput(json_encode($json));
		}
	}


	public function validate($address)
    {
        $decoded = $this->decodeBase58($address);
        $d1      = hash("sha256", substr($decoded, 0, 21), true);
        $d2      = hash("sha256", $d1, true);
        if (substr_compare($decoded, $d2, 21, 4)) {
            throw new Exception("bad digest");
        }
        
        return true;
    }
    
    public function decodeBase58($input)
    {
        $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
        $out      = array_fill(0, 25, 0);
        for ($i = 0; $i < strlen($input); $i++) {
            if (($p = strpos($alphabet, $input[$i])) === false) {
                throw new Exception("invalid character found");
            }
            
            $c = $p;
            for ($j = 25; $j--;) {
                $c += (int) (58 * $out[$j]);
                $out[$j] = (int) ($c % 256);
                $c /= 256;
                $c = (int) $c;
            }
            
            if ($c != 0) {
                throw new Exception("address too long");
            }
        }
        
        $result = "";
        foreach ($out as $val) {
            $result .= chr($val);
        }
        
        return $result;
    }
    
    public function check_address_btc($address_btc)
    {
        $address         = $address_btc;
        $message = 1;
        try {
            $abc = $this->validate($address);
        }
        
        catch (Exception $e) {
            $message = -1;
            
            // $json['message'] = $e->getMessage();
            
        }
        
        // $this->response->setOutput(json_encode($json));
        return $message;

    }
    public function searchBinary() {
		if ($this -> customer -> isLogged() && $this -> request -> get['account']) {
			$this -> load -> model('account/customer');
			$tree = $this -> model_account_customer -> get_customer_like_username($this -> request -> get['account']);
			
			$json['id_tree'] = $this -> session -> data['customer_id'];
			if (count($tree) > 0) {
				$id_binary = $this -> model_account_customer -> get_id_in_binary($this -> session -> data['customer_id']);
				$check_id = substr($id_binary, 1);
				$tree_id = explode(',', $check_id);
				
				$customers = in_array($tree['code'], $tree_id) ? 1 : 0;
				if (intval($customers) === 1) {
					$json['id_tree'] = $tree['code'];
				}else{
					$json['id_tree'] = $this -> session -> data['customer_id'];
				}
			}
			
		}else{
			$json['id_tree'] = $this -> session -> data['customer_id'];
		}
		
		$this -> response -> setOutput(json_encode($json));
	}
}
