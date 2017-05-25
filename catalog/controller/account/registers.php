<?php
class ControllerAccountRegisters extends Controller {
	private $error = array();

	public function index() {

		!array_key_exists('ref', $this -> request -> get) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));


		$this -> document -> addScript('catalog/view/javascript/register/register.js');
		$this -> load -> language('account/register');

		 $this -> document -> setTitle('Register User');

		$this -> load -> model('account/customer');
		$this -> load -> model('customize/country');
		/*check ---- sql*/
			$filter_wave2 = Array('"', "'");
    		foreach($_POST as $key => $value)
        	$_POST[$key] = $this -> replace_injection($_POST[$key], $filter_wave2);
    		foreach($_GET as $key => $value)
        	$_GET[$key] = $this -> replace_injection($_GET[$key], $filter_wave2);
        /*check ---- sql*/

		$data['customercode'] = $customer_get = $this -> model_account_customer -> getCustomerbyCode($_GET['ref']);

		count($customer_get) === 0 && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));

		$data['self'] = $this;

		$data['customer_id'] = $customer_get['customer_id'];
		$data['actionWallet'] = $this -> url -> link('account/personal/checkwallet', '', 'SSL');

		$data['country'] = $this -> model_customize_country -> getCountry();
		$data['action'] = $this -> url -> link('account/registers/confirmSubmit', 'ref=' . $_GET['ref'], 'SSL');
		$data['actionCheckUser'] = $this -> url -> link('account/registers/checkuser', '', 'SSL');
		$data['actionCheckEmail'] = $this -> url -> link('account/registers/checkemail', '', 'SSL');
		$data['actionCheckPhone'] = $this -> url -> link('account/registers/checkphone', '', 'SSL');
		$data['actionCheckCmnd'] = $this -> url -> link('account/registers/checkcmnd', '', 'SSL');
		// $data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this -> load -> controller('common/footer');
		$data['header'] = $this -> load -> controller('common/header');
		$this -> load -> model('account/customer');
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/register.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/register.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/register.tpl', $data));
		}
	}
	public function replace_injection($str, $filter)
	{
		foreach($filter as $key => $value)
			$str = str_replace($filter[$key], "", $str);
			return $str;
	}
	public function confirmSubmit() {
		/*check ---- sql*/
			$filter_wave2 = Array('"', "'");
    		foreach($_POST as $key => $value)
        	$_POST[$key] = $this -> replace_injection($_POST[$key], $filter_wave2);
    		foreach($_GET as $key => $value)
        	$_GET[$key] = $this -> replace_injection($_GET[$key], $filter_wave2);
        /*check ---- sql*/
		if ($this->request->server['REQUEST_METHOD'] === 'POST'){

			$this -> load -> model('customize/register');
			$this -> load -> model('account/auto');
			$this -> load -> model('account/customer');
			
			
			$checkEmail = intval($this -> model_customize_register -> checkExitEmail($_POST['email'])) === 1 ? 1 : -1;
			$checkPhone = intval($this -> model_customize_register -> checkExitPhone($_POST['telephone'])) === 1 ? 1 : -1;
			

			if ($checkEmail == 1 || $checkPhone == 1) {
				die('Error');
			}
			
			$transaction_password = $this->request->post['transaction_password'] = rand(100000,999999);
			$tmp = $this -> model_customize_register -> addCustomerByToken($this->request->post);

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

			$checkshare_Wallet = $this -> model_account_customer -> checkshare_Wallet($cus_id);
			if(intval($checkshare_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insert_share_Wallet($cus_id)){
					die();
				}
			}

			$check_Setting_Customer = $this -> model_account_customer -> check_Setting_Customer($cus_id);
			if(intval($check_Setting_Customer['number'])  === 0){

				$ga = new PHPGangsta_GoogleAuthenticator();
				$key_authenticator = $ga->createSecret();

				if(!$this -> model_account_customer -> insert_customer_setting($cus_id,$key_authenticator)){
					die();
				}
			}
			



			$data['has_register'] = true;
			$getCountryByID = $this -> model_account_customer -> getCountryByID(intval($this-> request ->post['country_id']));
			//$this -> response -> redirect($this -> url -> link('account/', '#success', 'SSL'));

			$data['has_register'] = true;
			$mail = new Mail();
			$mail -> protocol = $this -> config -> get('config_mail_protocol');
			$mail -> parameter = $this -> config -> get('config_mail_parameter');
			$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
			$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
			$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
			$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

			$mail -> setTo($_POST['email']);
			$mail -> setFrom($this -> config -> get('config_email'));
			$mail -> setSender(html_entity_decode("Mackayshieldslife", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("Registration Confirmed!");
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
			       	<div style="font-size:14px;font-weight:bold; margin-top:25px; margin-bottom:30px;">Hello <span style="color:#01aeef">'.$this-> request ->post['username'].'</span></div>
			       	<h2>Greetings from <span style="color:#01aeef">Mackayshieldslife! </span></h2>

			       	<p>Thank you for applying to open an Mackayshieldslife Account with us</p>

			       	<table width="70%" cellspacing="0" cellpadding="4" align="center" border="1" rules="all">
						   <tbody>
						      <tr>
						         <td colspan="3" align="center" bgcolor="#fff"><span style="font-size:16px"><strong>Account Details</strong></span></td>
						      </tr>
						      <tr>
						         <td width="50%" align="right">Full Name</td>
						         
						         <td width="47%">'.$this-> request ->post['username'].'</td>
						      </tr>
						      <tr>
						         <td align="right">Affilate  ID </td>
						         
						         <td>'.$getCountryByID['iso_code_2'].($cus_id + 100000).'</td>
						      </tr>
						      <tr>
						         <td align="right">Login Password </td>
						        
						         <td>'.$this-> request ->post['password'].'</td>
						      </tr>
						      <tr>
						         <td align="right">Password For Transaction</td>
						         
						         <td>'.$transaction_password.'</td>
						      </tr>
						   </tbody>
						</table>
						<p style="margin-bottom:10px; line-height:25px;">This is an auto generated password. You are advised to change your password as per your convenience.</p>
						<p style="margin-bottom:10px; line-height:25px;">
							We thank you again for your interest in opening Mackayshieldslife Account. Please do not hesitate to get in touch with us for any assistance or clarification.
						</p>
						<p style="margin-bottom:10px; line-height:25px;">
							Active account <a href="'.HTTPS_SERVER.'active.html&code='.$code_active.'&active='.sha1($code_active).md5(rand()).md5(rand()).md5(rand()).'" >'.HTTPS_SERVER.'active.html&code='.$code_active.'&active='.sha1($code_active).md5(rand()).md5(rand()).md5(rand()).'</a>
						</p>
						
						<p style="margin-bottom:10px; line-height:25px;">
							Sincerely
						</p>
						<p style="margin-bottom:10px; line-height:25px;">
							Mackayshieldslife
						</p>
   	
			       </tr>
			    </tbody>
			    </table>
			  </div>';
			
			$this -> session -> data['fullname'] = $this-> request ->post['username'];
			unset($this -> session -> data['customer_id']);
			$this-> model_customize_register -> update_template_mail($code_active, $html_mail);
			$mail -> setHtml($html_mail);
			
			$mail -> send();

			
			
			$this->session->data['register_mail'] = $this-> request ->post['email'];
			unset($this->session->data['customer_id']);
			$this -> response -> redirect(HTTPS_SERVER . 'login.html#success');
			
		}
	}
	public function create_wallet_blockio($lable){
		$block_io_a = new BlockIo(key_cm, pin_cm, block_version);
		$wallet = $block_io_a->get_new_address(array('label' => $lable));
		unset($block_io_a);
		return $wallet->data->address;
	}
	public function get_address_balance($address){
		$block_io_a = new BlockIo(key_cm, pin_cm, block_version);
		$balances = $block_io_a->get_address_balance(array('addresses' => $address));
		$balances['available_balance'] = $balances->data->available_balance;
		$balances['pending_received_balance'] = $balances->data->pending_received_balance;
		unset($block_io_a);
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
	public function checkuser() {
		if ($this -> request -> get['username']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitUserName($this -> request -> get['username'])) === 1 ? 1 : 0;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkemail() {
		if ($this -> request -> get['email']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitEmail($this -> request -> get['email'])) < 100 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function checkphone() {
		if ($this -> request -> get['phone']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitPhone($this -> request -> get['phone'])) < 100 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkcmnd() {
		if ($this -> request -> get['cmnd']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitCMND($this -> request -> get['cmnd'])) < 100 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

}
