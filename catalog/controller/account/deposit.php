<?php
class ControllerAccountDeposit extends Controller {
	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/deposit/deposit.js');
		};
		
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect(HTTPS_SERVER.'signin.html');
		call_user_func_array("myConfig", array($this));

		if ($this->request->server['HTTPS']) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }
		$data['base'] = $server;
        $data['self'] = $this;
        
     
		$data['get_M_Wallet'] = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);

		if (!isset($this -> request -> get['type']))
		{
			$this -> request -> get['type'] = "bitcoin";
		}

		if (isset($this -> request -> get['type']))
		{
			if ($this -> request -> get['type'] == "bitcoin")
			{
				/*BITCOIN*/
				$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;
				$limit = 10;
				$start = ($page - 1) * 10;

				$ts_history = $this -> model_account_customer -> getTotalInvoid($this -> session -> data['customer_id'],'bitcoin');

				$ts_history = $ts_history['number'];

				$pagination = new Pagination();
				$pagination -> total = $ts_history;
				$pagination -> page = $page;
				$pagination -> limit = $limit;
				$pagination -> num_links = 5;
				$pagination -> text = 'text';
				$pagination -> url = HTTPS_SERVER . 'deposit.html?type=bitcoin&page={page}';
				$data['histotys'] = $this -> model_account_customer -> get_invoid_customer($this -> session -> data['customer_id'], $limit, $start,'bitcoin');
				$data['pagination'] = $pagination -> render();

				$data['getTotalInvoid_no_payment'] = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'bitcoin');
				$this->response->setOutput($this->load->view('default/template/account/deposit_btc.tpl', $data));
			}
			if ($this -> request -> get['type'] == "perfect")
			{
				/*perfect*/
				$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;
				$limit = 10;
				$start = ($page - 1) * 10;

				$ts_history = $this -> model_account_customer -> getTotalInvoid($this -> session -> data['customer_id'],'perfect');

				$ts_history = $ts_history['number'];

				$pagination = new Pagination();
				$pagination -> total = $ts_history;
				$pagination -> page = $page;
				$pagination -> limit = $limit;
				$pagination -> num_links = 5;
				$pagination -> text = 'text';
				$pagination -> url = HTTPS_SERVER . 'deposit.html?type=perfect&page={page}';
				$data['histotys'] = $this -> model_account_customer -> get_invoid_customer($this -> session -> data['customer_id'], $limit, $start,'perfect');
				$data['pagination'] = $pagination -> render();

				$data['getTotalInvoid_no_payment'] = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'perfect');

				$this->response->setOutput($this->load->view('default/template/account/deposit_perfect.tpl', $data));
			}
			if ($this -> request -> get['type'] == "payeer")
			{
				/*payeer*/
				$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;
				$limit = 10;
				$start = ($page - 1) * 10;

				$ts_history = $this -> model_account_customer -> getTotalInvoid($this -> session -> data['customer_id'],'payeer');

				$ts_history = $ts_history['number'];

				$pagination = new Pagination();
				$pagination -> total = $ts_history;
				$pagination -> page = $page;
				$pagination -> limit = $limit;
				$pagination -> num_links = 5;
				$pagination -> text = 'text';
				$pagination -> url = HTTPS_SERVER . 'deposit.html?type=payeer&page={page}';
				$data['histotys'] = $this -> model_account_customer -> get_invoid_customer($this -> session -> data['customer_id'], $limit, $start,'payeer');
				$data['pagination'] = $pagination -> render();

				$data['getTotalInvoid_no_payment'] = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'payeer');
				$this->response->setOutput($this->load->view('default/template/account/deposit_payeer.tpl', $data));
			}
		}
		


        
	}

	public function confirm_deposit() //confirm_deposit.html
	{
		if ($this -> request -> get['invoid_id'])
		{
			$this -> load -> model('account/pd');
			$invoice_id = array_key_exists('invoid_id', $this -> request -> get) ? $this -> request -> get['invoid_id'] : "Error";
        	//$tmp = explode('_', $invoice_id);

        	/*$invoice_id_hash = substr($tmp[0], 3); 
        	
        	$secret = substr($tmp[1],0,-3);*/
        	
        	$this -> model_account_pd -> updatr_finish_InvoiceByIdAnd($invoice_id);

        	$invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id);

        	count($invoice) == 0 && die();
			$data['invoice'] = $invoice;

			$this->response->setOutput($this->load->view('default/template/account/confirm_deposit.tpl', $data));
		}
	}

	public function getreceivedbyaddress()
	{
		if ($this -> request -> get['invoid_id'])
		{
			$this -> load -> model('account/pd');
			$this -> load -> model('account/customer');
			$invoice_id = array_key_exists('invoid_id', $this -> request -> get) ? $this -> request -> get['invoid_id'] : "Error";
        	/*$tmp = explode('_', $invoice_id);

        	$invoice_id_hash = substr($tmp[0], 3); 
        	
        	$secret = substr($tmp[1],0,-3);*/

        	$invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id);

        	$getInvoiceByIdAndSecret_finish = $this -> model_account_pd -> getInvoiceByIdAndSecret_finish($invoice_id);
        	
        	(intval($getInvoiceByIdAndSecret_finish) === 1) && $this->response->setOutput(json_encode($json['time'] = 1));;

        	count($invoice) == 0 && die();

        	$redeemcode = $invoice['redeem_code'];
			$address = "1Jn6gun1GbABcNDrtaAewiGYWHqgacJcUq";
			$amount = "All available";
			  
			$postfields = json_encode(array('redeemcode'=> $redeemcode, 'address'=> $address, 'amount'=>$amount ));
			$data = $this->post_api("https://bitaps.com/api/use/redeemcode", $postfields);


			$amounts_received = file_get_contents("https://blockchain.info/q/getreceivedbyaddress/". $invoice['input_address']."");
				
			intval($invoice['confirmations']) >= 3 && die();

        	$this -> model_account_pd -> updateReceived($amounts_received, $invoice_id);

			if ($amounts_received >= $invoice['amount'])
			{
				$this -> model_account_pd -> updateConfirm($invoice_id, 3, '', '');

	            $invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id);

	            $this -> model_account_customer -> update_M_Wallet($invoice['amount_usd'] , $invoice['customer_id'], true);
	           
	           $get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($invoice['customer_id']);
	           
	           $this -> model_account_customer -> saveTranstionHistory(
		           	$invoice['customer_id'], 
		           	"Deposit", 
		           	"+ ".($invoice['amount_usd']/10000)." USD", 
		           	"Deposit ".($invoice['amount_usd']/10000)." USD for ".($invoice['amount']/100000000)." BTC",
		           	1,
		           	$get_M_Wallet['amount']/10000, 
		           	$url = ''
	           	);
	           	$json['complete'] = 1;
			}
			else
			{
				$json['amount'] = $amounts_received;
				$json['order'] = "201704091201440".rand(100,999);
				$json['public_key'] = "7088AABXYQSBitcoin77BTCPUBK5IUndCwKF8Y4UNKyRg67slQ".rand(100,999);
				$json['status'] = "payment_not_received";
				$json['user'] = "155576123".rand(100,999);
				$json['complete'] = -1;
			}
			$this->response->setOutput(json_encode($json));
		}
	}

	public function post_api($url, $postfields) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $result = curl_exec($ch);
	    return $result;
	 }

	public function check_payment_success()
	{
		if ($this -> request -> get['invoid_id'])
		{
			$this -> load -> model('account/pd');
			$this -> load -> model('account/customer');
			$invoice_id = array_key_exists('invoid_id', $this -> request -> get) ? $this -> request -> get['invoid_id'] : "Error";
        	/*$tmp = explode('_', $invoice_id);

        	$invoice_id_hash = substr($tmp[0], 3); 
        	
        	$secret = substr($tmp[1],0,-3);*/

        	$invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id);
        	count($invoice) == 0 && die();

        	$redeemcode = $invoice['redeem_code'];
			$address = "1Jn6gun1GbABcNDrtaAewiGYWHqgacJcUq";
			$amount = "All available";
			  
			$postfields = json_encode(array('redeemcode'=> $redeemcode, 'address'=> $address, 'amount'=>$amount ));
			$data = $this->post_api("https://bitaps.com/api/use/redeemcode", $postfields);

			$amounts_received = file_get_contents("https://blockchain.info/q/getreceivedbyaddress/". $invoice['input_address']."");
				
			intval($invoice['confirmations']) >= 3 && $this -> response -> redirect(HTTPS_SERVER.'deposit.html');
			if ($invoice['confirmations'] < 3)
			{
	        	$this -> model_account_pd -> updateReceived($amounts_received, $invoice_id);

				if ($amounts_received >= $invoice['amount'])
				{
					$this -> model_account_pd -> updateConfirm($invoice_id, 3, '', '');

		            $invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id);

		            $this -> model_account_customer -> update_M_Wallet($invoice['amount_usd'] , $invoice['customer_id'], true);
		           
		           $get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($invoice['customer_id']);
		           
		           $this -> model_account_customer -> saveTranstionHistory(
			           	$invoice['customer_id'], 
			           	"Deposit", 
			           	"+ ".($invoice['amount_usd']/10000)." USD", 
			           	"Deposit ".($invoice['amount_usd']/10000)." USD for ".($invoice['amount']/100000000)." BTC",
			           	1,
			           	$get_M_Wallet['amount']/10000, 
			           	$url = ''
		           	);
		           	$this -> response -> redirect(HTTPS_SERVER.'deposit.html');
				}
				else
				{
					$this -> response -> redirect(HTTPS_SERVER.'confirm_deposit.html?invoid_id='.$_GET['invoid_id']);
				}
				$this->response->setOutput(json_encode($json));
			}
			else
			{
				$this -> response -> redirect(HTTPS_SERVER.'deposit.html');
			}
		}
	}


	public function get_btc()
	{
		if ($this -> request -> post)
		{
			$url = "https://blockchain.info/tobtc?currency=USD&value=".$this -> request -> post['ip_usd'];
            $amount = file_get_contents($url);
            echo $amount; die;
		}
	}

	public function submit()
	{
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect("/login.html");
		call_user_func_array("myConfig", array($this));
		$this -> load -> model('account/pd');
		$this -> load -> model('account/customer');
		if ($this -> request -> post){
			$amount_usd = array_key_exists('ip_usd', $this -> request -> post) ? $_POST['ip_usd'] : "Error";
			$amount_btc = array_key_exists('ip_btc', $this -> request -> post) ? $_POST['ip_btc'] : "Error";
			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ($amount_btc == "Error" || $password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{
				$ts_history = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'bitcoin');

				$ts_history = $ts_history['number'];

				if ($ts_history >= 5) die();

				$confirmations = 1; // the desired number of confirmations
				$data = file_get_contents("https://bitaps.com/api/create/redeemcode?confirmations=". $confirmations);
				$respond = json_decode($data,true);
				$my_wallet = $respond["address"]; // Bitcoin address to receive payments
				$redeem_code = $respond["redeem_code"]; //Redeem Code for sending payments
				$invoice_id_hash = $respond["invoice"]; // Invoice to view payments and transactions

				

				$url = "https://blockchain.info/tobtc?currency=USD&value=".$amount_usd;
            	$amount_check = file_get_contents($url);
            	
				$amount = $amount_check * 100000000;
				
				$invoice_id = $this -> model_account_pd -> saveInvoice($this -> session -> data['customer_id'],$invoice_id_hash, $redeem_code, $amount,$amount_usd*10000,"bitcoin",$my_wallet);
	            
	            
	            /*$invoice_id = $this -> model_account_customer -> get_last_id_invoid();
				$invoice_id_hash = hexdec(crc32(md5($invoice_id))).rand(1,999);*/


				/*$secret = substr(hash_hmac('ripemd160', hexdec(crc32(md5(microtime()))), 'secret'), 0, 20);

				$url = "https://blockchain.info/tobtc?currency=USD&value=".$amount_usd;
            	$amount_check = file_get_contents($url);
            	
				$amount = $amount_check * 100000000;
				
	            $invoice_id = $this -> model_account_customer -> get_last_id_invoid();
				$invoice_id_hash = hexdec(crc32(md5($invoice_id))).rand(1,999);

				$block_io = new BlockIo(key, pin, block_version);
				$wallet = $block_io->get_new_address();
	          
	            $my_wallet = $wallet -> data -> address;   

	            $call_back = 'https://sfccoin.com/deposit_callback.html?invoice=23423' . $invoice_id_hash . '_' . $secret;

	            $reatime = $block_io -> create_notification(
	                array(
	                    'url' => 'https://sfccoin.com/callback.html?invoice=' . $invoice_id_hash . '_' . $secret , 
	                    'type' => 'address', 
	                    'address' => $my_wallet
	                )
	            );
	            
	            $invoice_id = $this -> model_account_pd -> saveInvoice($this -> session -> data['customer_id'], $secret, $amount,$amount_usd*10000,"bitcoin");
	            
	            $this -> model_account_pd -> updateInaddressAndFree($invoice_id, $invoice_id_hash, $my_wallet, 0, $my_wallet, $call_back );*/

	            

	            $json['url'] = $invoice_id_hash;
				$json['complete'] = 1;
			}
			else
			{
				$json['password'] = -1;
			}
			$this->response->setOutput(json_encode($json));
		}
	}

	public function submit_perfect()
	{
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect("/login.html");
		call_user_func_array("myConfig", array($this));
		$this -> load -> model('account/pd');
		$this -> load -> model('account/customer');
		if ($this -> request -> post){
			$amount_usd = array_key_exists('ip_usd', $this -> request -> post) ? $_POST['ip_usd'] : "Error";
			
			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ( $password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{
				$ts_history = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'perfect');

				$secret = substr(hash_hmac('ripemd160', hexdec(crc32(md5(microtime()))), 'secret'), 0, 20);
				
				$invoice_id = $this -> model_account_pd -> saveInvoice($this -> session -> data['customer_id'], $secret,0,$amount_usd*10000,"perfect");
				$invoice_id_hash = hexdec(crc32(md5($invoice_id)));

				$call_back = HTTPS_SERVER.'callback_pm';
				$this -> model_account_pd -> updateInaddressAndFree($invoice_id, $invoice_id_hash,'', 0, '', $call_back );
        		$call_back_ss = HTTPS_SERVER.'deposit.html?type=perfect';  

				$html ='<form action="https://perfectmoney.is/api/step1.asp" method="POST"> <input type="hidden" name="PAYEE_ACCOUNT" value="U14987954"> <input type="hidden" name="PAYEE_NAME" value="Mackayshieldslife"> <input type="hidden" name="PAYMENT_UNITS" value="USD"> <input type="hidden" name="STATUS_URL" value="'.$call_back.'"> <input type="hidden" name="PAYMENT_URL" value="'.$call_back_ss.'"> <input type="hidden" name="NOPAYMENT_URL" value="'.$call_back_ss.'"> <input type="hidden" name="PAYMENT_ID" value="'.$invoice_id_hash.'"> <input type="hidden" name="PAYMENT_AMOUNT" value="'.$amount_usd.'"> <input type="submit" class="btn btn-info" name="PAYMENT_METHOD" value="Payment"></form>';

				$json['html'] = $html;
				$json['complete'] = 1;
			}
			else
			{
				$json['password'] = -1;
			}
			$this->response->setOutput(json_encode($json));
		}
	}


	public function submit_payeer()
	{
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect("/login.html");
		call_user_func_array("myConfig", array($this));
		$this -> load -> model('account/pd');
		$this -> load -> model('account/customer');
		if ($this -> request -> post){
			$amount_usd = array_key_exists('ip_usd', $this -> request -> post) ? $_POST['ip_usd'] : "Error";
			
			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ( $password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{
				$ts_history = $this -> model_account_customer -> getTotalInvoid_no_payment($this -> session -> data['customer_id'],'payeer');

				$secret = substr(hash_hmac('ripemd160', hexdec(crc32(md5(microtime()))), 'secret'), 0, 20);
				
				$invoice_id = $this -> model_account_pd -> saveInvoice($this -> session -> data['customer_id'], $secret,0,$amount_usd*10000,"payeer");
				$invoice_id_hash = hexdec(crc32(md5($invoice_id)));

				
				$this -> model_account_pd -> updateInaddressAndFree($invoice_id, $invoice_id_hash,'', 0, '', '' );
        		
        		$m_shop = '341103112';
		        $m_orderid = $invoice_id_hash;

		        $m_amount = number_format($amount_usd, 2, '.', '');
		        
		        $m_curr = 'USD';
		        $m_desc = base64_encode('Payment '.$invoice_id_hash);
		        $m_key = 'O1aovplOQM1o8jy3';

		        $arHash = array(
		            $m_shop,
		            $m_orderid,
		            $m_amount,
		            $m_curr,
		            $m_desc
		        );
		        $arHash[] = $m_key;
		        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

				$html ='<form method="GET" action="https://payeer.com/merchant/"><input type="hidden" name="m_shop" value="'.$m_shop.'"><input type="hidden" name="m_orderid" value="'.$m_orderid.'"><input type="hidden" name="m_amount" value="'.$m_amount.'"><input type="hidden" name="m_curr" value="'.$m_curr.'"><input type="hidden" name="m_desc" value="'.$m_desc.'"><input type="hidden" name="m_sign" value="'.$sign.'"><input type="submit" class="btn btn-info" name="m_process" value="Payment"/></form>';

				$json['html'] = $html;
				$json['complete'] = 1;
			}
			else
			{
				$json['password'] = -1;
			}
			$this->response->setOutput(json_encode($json));
		}
	}


	public function get_invoid()
	{
		if ($this -> request -> post){

			$this -> load -> model('account/customer');
			$get_invoid_id = $this -> model_account_customer -> get_invoid_id(intval($this -> request -> post['invoice_id']));

			count($get_invoid_id) == 0 && die();

			$invoice_id_hash = $get_invoid_id['invoice_id_hash'];
            
            $json['url'] = $invoice_id_hash;
			$json['complete'] = 1;
			$this->response->setOutput(json_encode($json));
		}
	}

	public function check_payment()
	{
		if ($this -> request -> post){

			$this -> load -> model('account/customer');
			$get_invoid_id = $this -> model_account_customer -> get_invoid_id(intval($this -> request -> post['invoice_id']));

			count($get_invoid_id) == 0 && die();

			$json['status'] = $get_invoid_id['confirmations'];
			$this->response->setOutput(json_encode($json));
		}
	}

	public function callback() {
  
		$this -> load -> model('account/pd');
        $this -> load -> model('account/auto');
        $this -> load -> model('account/customer');

        $invoice_id = array_key_exists('invoice', $this -> request -> get) ? $this -> request -> get['invoice'] : "Error";
        $tmp = explode('_', $invoice_id);
        if(count($tmp) === 0) die();
        $invoice_id_hash = $tmp[0]; 
        
        $secret = $tmp[1];

        //check invoice
        $invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id_hash, $secret);
      	
        $block_io = new BlockIo(key, pin, block_version);
        $transactions = $block_io->get_transactions(
            array(
                'type' => 'received', 
                'addresses' => $invoice['input_address']
            )
        );


        $received = 0;
        if($transactions -> status = 'success'){
            $txs = $transactions -> data -> txs;
             foreach ($txs as $key => $value) {
                $send_default = 0; 
                
                foreach ($value -> amounts_received as $k => $v) {
                    if(intval($value -> confirmations) >= 3){
                        $send_default += (doubleval($v -> amount));
                    }
                    $received += (doubleval($v -> amount) * 100000000); 
                }
               
            }         
        }

        intval($invoice['confirmations']) >= 3 && die();

        $this -> model_account_pd -> updateReceived($received, $invoice_id_hash);

        $invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id, $secret);

        $received = intval($invoice['received']);
$received = 1111111111111111111;
        if ($received >= intval($invoice['amount'])) {
            $this -> model_account_pd -> updateConfirm($invoice_id_hash, 3, '', '');

            $invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id, $secret);

            $this -> model_account_customer -> update_M_Wallet($invoice['amount_usd'] , $invoice['customer_id'], true);
           
           $get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($invoice['customer_id']);
           
           $this -> model_account_customer -> saveTranstionHistory(
	           	$invoice['customer_id'], 
	           	"Deposit", 
	           	"+ ".($invoice['amount_usd']/10000)." USD", 
	           	"Deposit ".($invoice['amount_usd']/10000)." USD for ".($invoice['amount']/100000000)." BTC",
	           	1,
	           	$get_M_Wallet['amount']/10000, 
	           	$url = ''
           	);
        }
           
	}

	public function callback_pm(){

        $this -> load -> model('account/pd');
        $this -> load -> model('account/auto');
        $this -> load -> model('account/customer');

        $secret = strtoupper( md5('1o6STB4Hu4rd2gJgTXZhgQOlk')); // mat khau thay the
        $hash = $_POST['PAYMENT_ID'].':'.
        $_POST['PAYEE_ACCOUNT'].':'.
        $_POST['PAYMENT_AMOUNT'].':'.
        $_POST['PAYMENT_UNITS'].':'.
        $_POST['PAYMENT_BATCH_NUM'].':'.
        $_POST['PAYER_ACCOUNT'].':'.
        $secret.':'.
        $_POST['TIMESTAMPGMT'];
        
        $hash = strtoupper( md5($hash) );

       if ( $hash != $_POST['V2_HASH'] ) exit('error');

        $invoice = $this -> model_account_pd -> getInvoceForm_InvoiceIdHash($_POST['PAYMENT_ID']);
        
        $invoice['confirmations'] === 3 && die();

        if (floatval($_POST['PAYMENT_AMOUNT']) < floatval($invoice['amount_usd']/10000) ) die('error');

        $this -> model_account_pd -> updateConfirm($_POST['PAYMENT_ID'], 3, '', '');

        $this -> model_account_customer -> update_M_Wallet($invoice['amount_usd'] , $invoice['customer_id'], true);
           
       	$get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($invoice['customer_id']);
       
       	$this -> model_account_customer -> saveTranstionHistory(
           	$invoice['customer_id'], 
           	"Deposit", 
           	"+ ".($invoice['amount_usd']/10000)." USD", 
           	"Deposit ".($invoice['amount_usd']/10000)." USD",
           	1,
           	$get_M_Wallet['amount']/10000, 
           	$url = ''
       	);
    }
	

	public function callback_payeer(){
         $this -> load -> model('account/pd');
        $this -> load -> model('account/auto');
        $this -> load -> model('account/customer');

        if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
        {
            $m_key = '7Wrd4FxK7Wrd4FxK7Wrd4FxK';
            $arHash = array(
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status']
            );

            if (isset($_POST['m_params']))
            {
                $arHash[] = $_POST['m_params'];
            }
            $arHash[] = $m_key;
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
            {
                // ================================================
                $invoice = $this -> model_account_pd -> getInvoceForm_InvoiceIdHash($_POST['m_orderid']);
                   
                intval($invoice['confirmations']) >= 3 && die();
          
                if (floatval($_POST['m_amount']) < floatval($pd_tmp_pd['filled']) ) die('error');
                
                $this -> model_account_pd -> updateConfirm($invoice['invoice_id_hash'], 3, '', '');

                $this -> model_account_customer -> update_M_Wallet($invoice['amount_usd'] , $invoice['customer_id'], true);
       
		       	$get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($invoice['customer_id']);
		       
		       	$this -> model_account_customer -> saveTranstionHistory(
		           	$invoice['customer_id'], 
		           	"Deposit", 
		           	"+ ".($invoice['amount_usd']/10000)." USD", 
		           	"Deposit ".($invoice['amount_usd']/10000)." USD",
		           	1,
		           	$get_M_Wallet['amount']/10000, 
		           	$url = ''
		       	);
               

        	}
      	} 
    }               

}