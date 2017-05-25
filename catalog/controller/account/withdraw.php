<?php
class ControllerAccountWithdraw extends Controller {
	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/withdraw/withdraw.js');
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
        $data['customer'] = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);
        $page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;

		$ts_history = $this -> model_account_customer -> getTotalwithdraw($this -> session -> data['customer_id']);

		$ts_history = $ts_history['number'];

		$pagination = new Pagination();
		$pagination -> total = $ts_history;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = HTTPS_SERVER . '?route=account/withdraw&page={page}';
		$data['histotys'] = $this -> model_account_customer -> get_withdraw_customer($this -> session -> data['customer_id'], $limit, $start);

		$data['pagination'] = $pagination -> render();

		$data['get_M_Wallet'] = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/withdraw.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/withdraw.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/withdraw.tpl', $data));
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
			$addres_wallet = array_key_exists('wallet', $this -> request -> post) ? $_POST['wallet'] : "Error";
			$payment = array_key_exists('payment', $this -> request -> post) ? $_POST['payment'] : "Error";

			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ($amount_btc == "Error" || $password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{

				$getTotalwithdraw_pedding = $this -> model_account_customer -> getTotalwithdraw_pedding($this->session->data['customer_id']);
				if ($getTotalwithdraw_pedding['number'] > 0)
				{
					$json['pedding'] = 1;
					return $this->response->setOutput(json_encode($json));
				}

				$getmaxPD = $this -> model_account_customer -> getmaxPD($this -> session -> data['customer_id']);
				if ($amount_usd*10000 > $getmaxPD['number']*5)
				{
					$json['maxfive'] = $getmaxPD['number']*5/10000;
					return $this->response->setOutput(json_encode($json));
				}
				

				$get_m_walleet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);
				if ($get_m_walleet['amount'] >= $amount_usd*10000*1.05)
				{

					$url = "https://blockchain.info/tobtc?currency=USD&value=".$amount_usd;
	            	$amount_check = file_get_contents($url);
	            	
					$amount = $amount_check * 100000000;


					$this -> model_account_customer -> update_m_Wallet_add_sub($amount_usd*10000*1.05,$this -> session -> data['customer_id'], $add = false);

					$get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);

					$this -> model_account_customer -> saveTranstionHistory(
			           	$this -> session -> data['customer_id'], 
			           	"Withdraw", 
			           	"- ".($amount_usd)." USD", 
			           	"Withdraw ".($amount_usd)." USD for ".($amount/100000000)." BTC. Fee 5% (".($amount_usd*0.05)." USD)",
			           	2,
			           	$get_M_Wallet['amount']/10000, 
			           	$url = ''
		           	);
					//save withdraw payment 
					
					$this -> model_account_customer -> saveWithdrawpayment($this -> session -> data['customer_id'],$amount_usd,$addres_wallet,$amount, $payment);

					$json['complete'] = 1;
	            }
	            else
				{
					$json['money_transfer'] = 1;
				}


				
			}
			else
			{
				$json['password'] = -1;
			}
			return $this->response->setOutput(json_encode($json));
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
			
			$addres_wallet = array_key_exists('wallet', $this -> request -> post) ? $_POST['wallet'] : "Error";
			$payment = array_key_exists('payment', $this -> request -> post) ? $_POST['payment'] : "Error";

			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ($password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{
				$getTotalwithdraw_pedding = $this -> model_account_customer -> getTotalwithdraw_pedding($this->session->data['customer_id']);
				if ($getTotalwithdraw_pedding['number'] > 0)
				{
					$json['pedding'] = 1;
					return $this->response->setOutput(json_encode($json));
				}

				$getmaxPD = $this -> model_account_customer -> getmaxPD($this -> session -> data['customer_id']);
				if ($amount_usd*10000 > $getmaxPD['number']*5)
				{
					$json['maxfive'] = $getmaxPD['number']*5/10000;
					return $this->response->setOutput(json_encode($json));
				}

				$get_m_walleet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);
				 
				if ($get_m_walleet['amount'] >= $amount_usd*10000*1.05)
				{
					$amount = $amount_usd;
					$this -> model_account_customer -> update_m_Wallet_add_sub($amount_usd*10000*1.05,$this -> session -> data['customer_id'], $add = false);

					$get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);

					$this -> model_account_customer -> saveTranstionHistory(
			           	$this -> session -> data['customer_id'], 
			           	"Withdraw", 
			           	"- ".($amount_usd)." USD", 
			           	"Withdraw ".($amount_usd)." USD for ".($amount/100000000)." BTC. Fee 5% (".($amount_usd*0.05)." USD)",
			           	2,
			           	$get_M_Wallet['amount']/10000, 
			           	$url = ''
		           	);
					//save withdraw payment
					
					$this -> model_account_customer -> saveWithdrawpayment($this -> session -> data['customer_id'],$amount_usd,$addres_wallet,$amount, $payment);

					$json['complete'] = 1;
	            }
	            else
				{
					$json['money_transfer'] = 1;
				}
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
			
			$addres_wallet = array_key_exists('wallet', $this -> request -> post) ? $_POST['wallet'] : "Error";
			$payment = array_key_exists('payment', $this -> request -> post) ? $_POST['payment'] : "Error";

			$password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
			if ($password_transaction == "Error" || $amount_usd == "Error") {
				return $json['error'] = -1;
			}
			$check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

			if ($check_password_transaction > 0)
			{
				
				$getTotalwithdraw_pedding = $this -> model_account_customer -> getTotalwithdraw_pedding($this->session->data['customer_id']);
				if ($getTotalwithdraw_pedding['number'] > 0)
				{
					$json['pedding'] = 1;
					return $this->response->setOutput(json_encode($json));
				}

				$getmaxPD = $this -> model_account_customer -> getmaxPD($this -> session -> data['customer_id']);
				if ($amount_usd*10000 > $getmaxPD['number']*5)
				{
					$json['maxfive'] = $getmaxPD['number']*5/10000;
					return $this->response->setOutput(json_encode($json));
				}
				$get_m_walleet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);
				 
				if ($get_m_walleet['amount'] >= $amount_usd*10000*1.05)
				{
					$amount = $amount_usd;
					$this -> model_account_customer -> update_m_Wallet_add_sub($amount_usd*10000*1.05,$this -> session -> data['customer_id'], $add = false);

					$get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);

					$this -> model_account_customer -> saveTranstionHistory(
			           	$this -> session -> data['customer_id'], 
			           	"Withdraw", 
			           	"- ".($amount_usd)." USD", 
			           	"Withdraw ".($amount_usd)." USD for ".($amount/100000000)." BTC. Fee 5% (".($amount_usd*0.05)." USD)",
			           	2,
			           	$get_M_Wallet['amount']/10000, 
			           	$url = ''
		           	);
					//save withdraw payment
					
					$this -> model_account_customer -> saveWithdrawpayment($this -> session -> data['customer_id'],$amount_usd,$addres_wallet,$amount, $payment);

					$json['complete'] = 1;
	            }
	            else
				{
					$json['money_transfer'] = 1;
				}
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

			$json['my_address'] = $get_invoid_id['my_address'];
            $json['ip_btc'] = $get_invoid_id['amount']/100000000;
            $json['ip_usd'] = $get_invoid_id['amount_usd']/10000;
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
	
}