<?php
class ControllerAccountPd extends Controller {

	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
		};
		$this -> load -> model('account/customer');
        $this -> load -> model('account/pd');
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		$customer = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);



		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;
		$pd_total = $this -> model_account_customer -> getTotalPD($this -> session -> data['customer_id']);

		$pd_total = $pd_total['number'];

		$pagination = new Pagination();
		$pagination -> total = $pd_total;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = str_replace('/index.php?route=', "/", $this -> url -> link('investment-detail.html', 'page={page}', 'SSL'));

		$data['pds'] = $this -> model_account_customer -> getPDById($this -> session -> data['customer_id'], $limit, $start);
		$data['pagination'] = $pagination -> render();

        $data['histotys'] = $this -> model_account_customer -> get_history_active_package($this -> session -> data['customer_id']);

		//get all PD
		$data['pd_all'] = $this -> model_account_customer ->getPD($this -> session -> data['customer_id']);
		
       
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pd.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pd.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pd.tpl', $data));
		}
	}
	public function countDay($id =null){
		$this -> load -> model('account/pd');
		$countDayPD = $this -> model_account_pd ->CountDayPD($id);
		echo ($countDayPD['number']) > 0 ? 1 : 2;
	}
	public function countTransferID($transferid =null){
		$this -> load -> model('account/pd');
		$countDayPD = $this -> model_account_pd ->countTransferID($transferid);
		return $countDayPD['number'] > 0 ? 1 : 2;
	}

	

	public function show_invoice_pending()
    {
        function myCheckLoign($self)
        {
            return $self->customer->isLogged() ? true : false;
        }
        ;
        function myConfig($self)
        {
            $self->load->model('account/customer');
            $self->load->model('account/pd');
        }
        ;
        //method to call function
        !call_user_func_array("myCheckLoign", array(
            $this
        )) && $this->response->redirect(HTTPS_SERVER . 'login.html');
        call_user_func_array("myConfig", array(
            $this
        ));
        $data['notCreate'] = true;
        $data['invoice']   = $this->model_account_pd->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);
        $data['self']      = $this;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/confirmPending.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/confirmPending.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/confirmPending.tpl', $data));
        }
    }
	 public function show_invoice()
    {
    
        function myCheckLoign($self)
        {
            return $self->customer->isLogged() ? true : false;
        }
        ;
        function myConfig($self)
        {
        	$self -> document -> addScript('catalog/view/javascript/pd/confirm.js');
            $self->load->model('account/customer');
            $self->load->model('account/pd');
        }
         
        //method to call function
        !call_user_func_array("myCheckLoign", array(
            $this
        )) && $this->response->redirect(HTTPS_SERVER . 'login.html');
        call_user_func_array("myConfig", array(
            $this
        ));

        !array_key_exists('invoice_hash', $this->request->get) && die();
        $invoice_hash = $this->request->get['invoice_hash'];

        $invoice      = $this->model_account_pd->getInvoceFormHash($invoice_hash, $this->session->data['customer_id']);

        !$invoice && $this->response->redirect(HTTPS_SERVER . 'login.html');
         
        $count_invoice     = $this->model_account_pd->countPD($this->session->data['customer_id']);
        $count_invoice     = $count_invoice['number'];
        $data['notCreate'] = false;
        if ($count_invoice > 6) {
            $data['notCreate'] = true;
            $data['invoice']   = $this->model_account_token->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);
        } else {
            $data['bitcoin'] = $invoice['amount'];
            $data['wallet']  = $invoice['input_address'];
            $data['date_added']  = $invoice['date_created'];
            $data['transfer_id']  = $invoice['transfer_id'];
            $data['received']  = $invoice['received'];
         	$data['confirmations']  = $invoice['confirmations'];
     	}
        $this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;

        $data['self'] = $this;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/checkConfirmPd.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/checkConfirmPd.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/checkConfirmPd.tpl', $data));
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

        if ($received >= intval($invoice['amount'])) {
  
            $this -> model_account_customer ->updateLevel($invoice['customer_id'], 2);

            $this -> model_account_pd -> updateConfirm($invoice_id_hash, 3, '', '');

            //update PD
            $this -> model_account_pd -> updateStatusPD($invoice['transfer_id'], 1);

            $pd_tmp_pd = $this -> model_account_pd -> getPD($invoice['transfer_id']);
            $pd_tmp_ = $pd_tmp_pd['filled'];
            switch (doubleval($pd_tmp_)) {
                case 50000000:
                    $percent_r_payment = 0.02;
                    $token = 5000;
                    break;
                case 100000000:
                    $percent_r_payment = 0.021;
                    $token = 10000;
                    break;
                case 500000000:
                    $percent_r_payment = 0.022;
                    $token = 50000;
                    break;
                case 1000000000:
                    $percent_r_payment = 0.023;
                    $token = 100000;
                    break;
                case 2000000000:
                    $percent_r_payment = 0.024;
                    $token = 200000;
                    break;
                case 5000000000:
                    $percent_r_payment = 0.025;
                    $token = 500000;
                    break;
                default:
                    die;
                    break;
            }
            $pd_tmp_ = $pd_tmp_ * $percent_r_payment;

            $this -> model_account_pd -> updateDatefinishPD($invoice['transfer_id'], $pd_tmp_);
            
            $customer = $this -> model_account_customer ->getCustomer($invoice['customer_id']);
            
            $this -> model_account_customer -> update_R_Wallet_add($pd_tmp_,$invoice['customer_id'], $customer['wallet'],$pd_tmp_pd['filled'],$percent_r_payment*1000);
            $this -> model_account_customer -> update_token_wallet($invoice['customer_id'],$token);
            
            $check_signup = intval($customer['check_signup']);

                //update pd left and right
                //get customer_ml p_binary
                $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($invoice['customer_id']);
                $customer_first = true ;
                if(intval($customer_ml['p_binary']) !== 0 && $check_signup !== 1){
                	$amount_binary = $pd_tmp_pd['filled'];
                    while (true) {
                        //lay thang cha trong ban Ml
                        $customer_ml_p_binary = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml['p_binary']);

                        if($customer_first){
                            //kiem tra la customer dau tien vi day la gia tri callback mac dinh
                            if(intval($customer_ml_p_binary['left']) === intval($invoice['customer_id']) )  {
                                //nhanh trai
                                $this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                                $this -> model_account_customer -> update_pd_left_right(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                                //$this -> model_account_customer -> saveTranstionHistory($customer_ml_p_binary['customer_id'], 'Bitcoin Left', '+ ' . ($amount_binary/100000000) . ' BTC', "From ".$customer['username']." Active Package # (".($amount_binary/100000000)." BTC)");   
                                
                            }else{
                                //nhanh phai
                                $this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                                $this -> model_account_customer -> update_pd_left_right(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                                //$this -> model_account_customer -> saveTranstionHistory($customer_ml_p_binary['customer_id'], 'Bitcoin Right', '+ ' . ($amount_binary/100000000) . ' BTC', "From ".$customer['username']." active Package # (".($amount_binary/100000000)." BTC)");   
                            }
                            $customer_first = false;
                        }else{
                
                            if(intval($customer_ml_p_binary['left']) === intval($customer_ml['customer_id']) ) {
                                //nhanh trai
                                $this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                                $this -> model_account_customer -> update_pd_left_right(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                                //$this -> model_account_customer -> saveTranstionHistory($customer_ml_p_binary['customer_id'], 'Bitcoin Left', '+ ' . ($amount_binary/100000000) . ' BTC', "From ".$customer['username']." active Package # (".($amount_binary/100000000)." BTC)");   
                            }else{
                                //nhanh phai
                                $this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                                $this -> model_account_customer -> update_pd_left_right(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                                //$this -> model_account_customer -> saveTranstionHistory($customer_ml_p_binary['customer_id'], 'Bitcoin Right', '+ ' . ($amount_binary/100000000) . ' BTC', "From ".$customer['username']." active Package # (".($amount_binary/100000000)." BTC)");   
                            }
                        }
                        
                        // level
                       
                        $count_p_node = $this -> model_account_customer -> count_p_node($customer_ml_p_binary['customer_id']);
                        $getmaxPD = $this -> model_account_customer -> getmaxPD($customer_ml_p_binary['customer_id']);
                        $getCustomer_binary = $this -> model_account_customer ->getCustomer($customer_ml_p_binary['customer_id']);
                        if ($getmaxPD['number'] >= 500000000 && intval($count_p_node) >= 2){
                            if (doubleval($getCustomer_binary['total_pd_left']) > doubleval($getCustomer_binary['total_pd_right'])){
                                $nhanhyeu = doubleval($getCustomer_binary['total_pd_right']);
                            }
                            else
                            {
                                $nhanhyeu = doubleval($getCustomer_binary['total_pd_left']);
                            }
                            $position = 0;
                            if ($nhanhyeu >= 15000000000)
                            {
                                $position = 1;
                                
                            }
                            $count_p_node_buy_level = $this -> model_account_customer -> count_p_node_buy_level($customer_ml_p_binary['customer_id'],1);
                            if ($count_p_node_buy_level >= 2){
                                $position = 2;
                            }
                            $count_p_node_buy_level = $this -> model_account_customer -> count_p_node_buy_level($customer_ml_p_binary['customer_id'],2);
                            if ($count_p_node_buy_level >= 2){
                                $position = 3;
                            }
                            $count_p_node_buy_level = $this -> model_account_customer -> count_p_node_buy_level($customer_ml_p_binary['customer_id'],3);
                            if ($count_p_node_buy_level >= 2){
                                $position = 4;
                            }
                            $count_p_node_buy_level = $this -> model_account_customer -> count_p_node_buy_level($customer_ml_p_binary['customer_id'],4);
                            if ($count_p_node_buy_level >= 2){
                                $position = 5;
                            }
                            $count_p_node_buy_level = $this -> model_account_customer -> count_p_node_buy_level($customer_ml_p_binary['customer_id'],5);
                            if ($count_p_node_buy_level >= 2){
                                $position = 6;
                            }
                            $this -> model_account_customer -> update_position_customer($customer_ml_p_binary['customer_id'],$position);
                        }
                        // end level  

                        if(intval($customer_ml_p_binary['customer_id']) === 1){
                            break;
                        }
                        //lay tiep customer de chay len tren lay thang cha
                        $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml_p_binary['customer_id']);

                    } 
                }

                 //=========Hoa hong bao tro=====================
                
                $partent = $this -> model_account_customer ->getCustomer($customer['p_node']);

               if (!empty($partent) && $check_signup !== 1) {

                    $this -> model_account_customer -> update_count_pode_payment($partent['customer_id']);
                // Check ! C Wallet 
                    $checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($partent['customer_id']);
                    if (intval($checkC_Wallet['number']) === 0) {
                        if (!$this -> model_account_customer -> insertC_Wallet($partent['customer_id'])) {
                            die();
                        }
                    }

                    // update pd_pnode
                     $this -> model_account_customer -> update_p_node_pd($pd_tmp_pd['filled'],$partent['customer_id'],true);

                    $customer = $this -> model_account_customer ->getCustomer($invoice['customer_id']);
	                   
	                
	                $amountPD = intval($pd_tmp_pd['filled']);

	                $this->commission_Parrent($invoice['customer_id'], $amountPD, $invoice['transfer_id']);
                    
               }
               
                $this->send_mail($customer['email'],($pd_tmp_pd['filled']/100000000),$customer['username']); 
           }
           
	}

    public function send_mail($email,$package,$username)
    {
        $mail = new Mail();
        $mail -> protocol = $this -> config -> get('config_mail_protocol');
        $mail -> parameter = $this -> config -> get('config_mail_parameter');
        $mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
        $mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
        $mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
        $mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

        //$mail -> setTo($this -> config -> get('config_email'));
        $mail -> setTo($email);
        $mail -> setFrom($this -> config -> get('config_email'));
        $mail -> setSender(html_entity_decode("Smart Financial Connections", ENT_QUOTES, 'UTF-8'));
        $mail -> setSubject("Active package success");
        $html_mail = '<div style="background: #f2f2f2; width:100%;">
           <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#2A363C;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
            width:700px; margin:0 auto">
           <tbody>
              <tr>
                <td>
                  <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'catalog/view/theme/default/img/logo.png" alt="logo" style="margin: 0 auto; width:150px;"></div>
                </td>
               </tr>
               <tr>
               <td style="background:#fff">
                <p class="text-center" style="font-size:20px;color: black;text-transform: uppercase; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;">congratulations !<p>
                <p class="text-center" style="color: black; width:100%; float:left;text-align: center;line-height: 15px;margin-bottom:30px;">Active package success</p>
<div style="width:600px; margin:0 auto; font-size=15px">

                    <p style="font-size:14px;color: black;margin-left: 70px;">Hi '.$username.'</p>
                    <p style="font-size:14px;color: black;margin-left: 70px;">Congratulations on your successful active package '.$package.' BTC</p>
                    <p style="font-size:14px;color: black;margin-left: 70px;">Thank you for your trust and use our services. Sincerely thank</p>
                      </div>
               </td>
               </tr>
            </tbody>
            </table>
          </div>';
        $mail -> setHtml($html_mail); 
        $mail -> send();
    }

    // percent 15 and 18
    public function get_percent_langer($customer_id,$percent)
    {
        $this->load->model('account/customer');
        $get_childrend_all_tree = $this -> model_account_customer -> count_child_langer($customer_id);

        $customer_curent = $this -> model_account_customer ->getCustomer($customer_id);


        if (count($get_childrend_all_tree) > 0)
        {
            $total_child_pd = 0;
            foreach ($get_childrend_all_tree as  $value) {
                $customer = $this -> model_account_customer ->getCustomer($value['customer_id']);
                $total_child_pd += $customer['total_pd_node'];
            }
            if (($customer_curent['total_pd_node'] - $total_child_pd) >= 30000000000)
            {
                $percents = $percent;
            }  
            else
            {
                if ($percent == 15)
                {
                    $percents = 13;
                }
                if ($percent == 18)
                {
                    $percents = 15;
                }

            } 
            
        }
        else
        {
            $percents = $percent;
        }
        return $percents;
    }

	public function commission_Parrent($customer_id, $amountPD){
        $this->load->model('account/customer');
        $this->load->model('account/auto');
        $customer = $this -> model_account_customer ->getCustomer($customer_id);
                
        $partent = $this -> model_account_customer ->getCustomer($customer['p_node']);

        $partent_customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($partent['customer_id']);

        $percent = 10;
        if (intval($partent_customer_ml['level']) >= 2) {

            $amounts_received = $amountPD * $percent / 100;

            $this -> model_account_customer -> update_m_Wallet_add_sub($amounts_received,$customer['p_node'], $add = true);

                $get_M_Wallet = $this -> model_account_customer -> get_M_Wallet($customer['p_node']);

                $this -> model_account_customer -> saveTranstionHistory(
                    $customer['p_node'], 
                    "Hoa hồng trực tiếp", 
                    "+ ".(number_format($amounts_received))." VNĐ", 
                    "Hoa hồng trực tiếp ".$percent."%, Từ ID ".$customer['username']." tham gia gói (".(number_format($amountPD))." VNĐ)",
                    1,
                    $get_M_Wallet['amount'], 
                    $url = ''
                ); 
        }
        
    }

	
    public function dequy_mattroi($customer_id,$package)
    {
        $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_id);
        $this -> model_account_customer -> update_pd_mattroi($customer_id, $package);
        $customer_id = $customer_ml['p_node'];

        while (true){
            $this -> model_account_customer -> update_pd_mattroi($customer_id, $package);
            $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_id);
            if (count($customer_ml) == 0)
            {
                break;
            }
            $customer_id = $customer_ml['p_node'];
        }

    }

    public function dequy_nhiphan($customer_id,$package)
    {
        $customer = $this -> model_account_customer ->getCustomer($customer_id);
        $check_signup = intval($customer['check_signup']);

        $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_id);
        $customer_first = true ;
        if(intval($customer_ml['p_binary']) !== 0 && $check_signup !== 1){
            
            $tang = 0;
            while (true) {
                $tang ++;

                if ($tang < 6)
                {
                    $amount_binary = $package*0.2;
                }
                else
                {
                    $amount_binary = $package*0.04;
                }

                //lay thang cha trong ban Ml
                $customer_ml_p_binary = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml['p_binary']);

                if($customer_first){
                   
                    if(intval($customer_ml_p_binary['left']) === intval($customer_id) )  {
                        //nhanh trai
                        $this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                      
                    }else{
                        //nhanh phai
                        $this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                         
                    }
                    $customer_first = false;
                }else{
        
                    if(intval($customer_ml_p_binary['left']) === intval($customer_ml['customer_id']) ) {
                        //nhanh trai
                        $this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $amount_binary );
                         
                    }else{
                        //nhanh phai
                        $this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $amount_binary );
                       
                    }
                }
                if(intval($customer_ml_p_binary['customer_id']) === 1){
                    break;
                }
                
                $customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml_p_binary['customer_id']);
            } 
        }
    }
	   


	public function get_invoice_transfer_id($transfer_id){
		$this -> load -> model('account/pd');
		$transfer_id = $this->model_account_pd -> countTransferID($transfer_id);
		$transfer_id = $transfer_id['number'];
		return $transfer_id;
	}
	
    

	public function pd_investment(){

		if(array_key_exists("packet",  $this -> request -> get) && $this -> customer -> isLogged()){


			$this -> load -> model('account/pd');
			$this -> load -> model('account/customer');
			$package = $this -> request -> get['packet'];
			$package = doubleval($package);

            switch ($package) {
                case 2500000:
                    $package = 2500000;
                    
                    break;
                case 5600000:
                    $package = 5600000;
                    
                    break;
                default:
                    $package = 0;
                    break;
            }		
            
            ($package === 0) && die("error");
			//check package
            $check_packet_pd = $this -> check_packet_pd($package);
            (count($check_packet_pd ) > 0) && die("error");


            $code = $this -> request -> get['code'];

            $get_code = $this -> model_account_customer -> get_code($code,$package);
            if (intval($get_code) > 0) // check code
            {
                // update code
                $this -> model_account_customer -> update_code($code,$package);

                $pd = $this -> model_account_customer ->createPD($package, 0);

                
                $this -> model_account_customer ->updateLevel($this -> session -> data['customer_id'], 2);
                // de quy left right 
                $this -> dequy_nhiphan($this -> session -> data['customer_id'],$package);

                // hoa hong truc tiep
                $customer = $this -> model_account_customer ->getCustomer($this -> session -> data['customer_id']);
                if ($customer['p_node'] != 0)
                {
                    $this -> commission_Parrent($this -> session -> data['customer_id'],$package);
                }

                $json['complete'] = 1;
            }
            else
            {
                $json['no_money'] = 1;
            }
			
            $this->response->setOutput(json_encode($json));
		}

	}


    public function upgray_investment()
    {
        if(array_key_exists("packet",  $this -> request -> get) && $this -> customer -> isLogged()){


            $this -> load -> model('account/pd');
            $this -> load -> model('account/customer');
            $package = $this -> request -> get['packet'];
            $package = doubleval($package);

            switch ($package) {
                case 2500000:
                    $package = 2500000;
                    
                    break;
                case 5600000:
                    $package = 5600000;
                    
                    break;
                default:
                    $package = 0;
                    break;
            }       
            
            ($package === 0) && die("error");
            //check package

            $code = $this -> request -> get['code'];

            $get_code = $this -> model_account_customer -> get_code($code,$package);
            if (intval($get_code) > 0) // check code
            {
                // update code
                $this -> model_account_customer -> update_code($code,$package);

                $pd = $this -> model_account_customer ->updatePD($package,$this -> session -> data['customer_id']);

                $json['complete'] = 1;
            }
            else
            {
                $json['no_money'] = 1;
            }
            
            $this->response->setOutput(json_encode($json));

        }
    }

	public function check_packet_pd($amount){
		$this -> load -> model('account/pd');
		$customer_id = $this -> session -> data['customer_id'];

		return $this -> model_account_pd -> check_packet_pd($customer_id, $amount);
	}

	public function packet_invoide(){
		$this -> load -> model('account/pd');
		$package = $this -> model_account_pd -> get_invoide($this -> request -> get ['invest']);
		if (intval($package['confirmations']) === 3) {
           $json['success'] = 1;
        }else
        {
        $json['input_address'] = $package['input_address'];
        $json['amount'] =  $package['amount_inv'];
        $json['package'] = $package['pd_amount'];
        $json['received'] =  $package['received'];
        }
        
		$this->response->setOutput(json_encode($json));
	}
    public function check_payment()
    {
        $this -> load -> model('account/pd');
        $check_payment = $this -> model_account_pd -> check_payment($this->session->data['customer_id']);
        $json['confirmations'] = $check_payment;
        $this->response->setOutput(json_encode($json));
    }

    public function team_commission(){
        
        $this -> load -> model('account/customer');
        /*TÍNH HOA HỒNG NHÁNH YẾU*/
        $getCustomer = $this -> model_account_customer -> getCustomer_commission();
        $bitcoin = "";
        $wallet = "";
        $inser_history = "";
        $sum = 0;
       foreach ($getCustomer as $value) {
       
        if ((doubleval($value['total_pd_left']) > 0 && doubleval($value['total_pd_right'])) > 0)
        {
            if (doubleval($value['total_pd_left']) > doubleval($value['total_pd_right'])){
                $balanced = doubleval($value['total_pd_right']);
                //$this -> model_account_customer -> update_total_pd_left(doubleval($value['total_pd_left']) - doubleval($value['total_pd_right']), $value['customer_id']);
                //$this -> model_account_customer -> update_total_pd_right(0, $value['customer_id']);
            }
            else
            {
                $balanced = doubleval($value['total_pd_left']);
               // $this -> model_account_customer -> update_total_pd_right(doubleval($value['total_pd_right']) - doubleval($value['total_pd_left']), $value['customer_id']);
               // $this -> model_account_customer -> update_total_pd_left(0, $value['customer_id']);
            }
            
            
            $precent = 2;
          
            $getTotalPD = $this-> model_account_customer -> getmaxPD($value['customer_id']);
            $amount = ($balanced*$precent)/100;

            if (doubleval($amount) > (doubleval($getTotalPD['number'])*2))
            {
                $amount = (doubleval($getTotalPD['number']))*2;
            }
            if ($value['level'] == 2)
            {
                $sum += doubleval($amount)/100000000;
                
                $btc = doubleval($amount)/100000000;
                $btc = $btc*0.97;
                
                $bitcoin .= ",".$btc;
                $wallet .= ",".$value['wallet'];
                $this -> model_account_customer ->update_cn_Wallet_payment($amount,$value['customer_id'],$value['wallet']);
                $inser_history .= ",".$this -> model_account_customer -> inser_history('+ '.(($amount)/100000000).' BTC','System Commission','Earn '.$precent.'%  weak team ('.($balanced/100000000).' BTC) but 2 times the investment package, Free 3%',$value['customer_id']);
            }
            
        }    
    }
    // print_r($inser_history);
     echo "<br/> btc".$bitcoin = substr($bitcoin,1);
     echo "<br/> wallet".$wallet = substr($wallet,1);
     echo "<br/> ".$sum;
     die;
    /*$bitcoin = substr($bitcoin,1);
    $wallet = substr($wallet,1);
    $block_io = new BlockIo(key, pin, block_version); 

    $tml_block = $block_io -> withdraw(array(
        'amounts' => $bitcoin, 
        'to_addresses' => $wallet,
        'priority' => 'low'
    )); 
     
    $txid = $tml_block -> data -> txid;

    $url = '<a target="_blank" href="https://blockchain.info/tx/'.$txid.'" >Link Transfer </a>';

    $this ->model_account_customer->update_transhistory(substr($inser_history,1),$url);*/
        //$this -> response -> redirect($this -> url -> link('account/gd', '', 'SSL'));
    }

    /*------------------------------*/
    
   
}
