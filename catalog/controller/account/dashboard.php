<?php
class ControllerAccountDashboard extends Controller {

	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			// $self -> document -> addScript('catalog/view/javascript/dashboard/dashboard.js');
			$self -> document -> addScript('catalog/view/javascript/Chart.bundle.js');
			// $self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> load -> model('simple_blog/article');
		};

		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect("/login.html");
		call_user_func_array("myConfig", array($this));
		
		$session_id = $this -> session -> data['customer_id'];

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($session_id);
		$data['language']= $getLanguage;
		$language = new Language($getLanguage);
		$language -> load('account/dashboard');
		$data['lang'] = $language -> data;
		$checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($session_id);
		if(intval($checkM_Wallet['number'])  === 0){
			if(!$this -> model_account_customer -> insert_M_Wallet($session_id)){
				die();
			}
		}
		$time = $this -> model_account_customer -> get_M_Wallet($session_id);
		
		$data['date'] = $time['date'];
		//method to call function

		$data['getall_user'] = $this->model_account_customer->getall_user();
		//insert inot payment_block_chain if not exit

		
		$data['get_chart'] = $this -> model_account_customer -> get_chart();

		//data render website
		//start load country model

		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}

		$data['base'] = $server;
		$data['self'] = $this;
		

		//customer js
		$data['m_wallet'] = $this -> model_account_customer -> get_M_Wallet($session_id);

		$data['getTotalPD'] = $this -> model_account_customer -> getTotalPD($session_id);
		
		$data['cannhanh'] = $this -> cannhanh($session_id);
		
		/*$data['total_binary_left'] = $this -> total_binary_left($session_id);
		$data['total_binary_right'] = $this -> total_binary_right($session_id);*/
		
		
		
		$customer = $this -> model_account_customer-> getCustomer($this -> session -> data['customer_id']);

		$Hash = $customer['customer_code'];	
		$data['customer'] = $customer;
		$data['customer_code'] = $Hash;

		$data['get_customer_activity'] = $this -> model_account_customer -> get_customer_activity($this->session->data['customer_id']);
		
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/dashboard.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/dashboard.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/login.tpl', $data));
		}
	}
		
	public function cannhanh($customer_id)
	{
		$this -> load -> model('account/customer');
		$customer = $this -> model_account_customer-> getCustomer($this -> session -> data['customer_id']);
		$check_f1_left = $this -> binary_left($customer_id);
		$check_f1_right  = $this -> binary_right($customer_id);

		$getgoidautu =$this -> model_account_customer ->getTotalPD($customer_id);
		
		if (doubleval($getgoidautu['number']) > 0 && intval($check_f1_left) === 1 && intval($check_f1_right) === 1 )
        {  
        	if ($customer['total_pd_left'] > $customer['total_pd_right'])
			{
				return $customer['total_pd_right'];
			}
			else
			{
				return $customer['total_pd_left'];
			}
        }
        else
        {
        	return 0;
        }
		
	}

	public function binary_right($customer_id){
		$this -> load -> model('account/customer');
		$check_f1 = $this -> model_account_customer -> check_p_node_binary_($customer_id);
		$listId= '';
		foreach ($check_f1 as $item) {
			$listId .= ',' . $item['customer_id'];
		}
		$arrId = substr($listId, 1);
		// $arrId = explode(',', $arrId);
		$count = $this -> model_account_customer ->  getCustomer_ML($customer_id);
		if(intval($count['right']) === 0){
			$customer_binary = ',0';
		}else{
			$id = $count['right'];
			$count = $this -> model_account_customer -> getCount_ID_BinaryTreeCustom($count['right']);
			$customer_binary = $count.','.$id;
		}
		$customer_binary = substr($customer_binary, 1);
		// $customer_binary = explode(',', $customer_binary);
		$array = $arrId.','.$customer_binary;
		$array = explode(',', $array);
		
		$array = array_count_values($array);
		
		$array = in_array(2, $array) ? 1 : 0;
		return $array;
	}
	public function binary_left($customer_id){

		$this -> load -> model('account/customer');
		
		$check_f1 = $this -> model_account_customer -> check_p_node_binary_($customer_id);
		
		$listId= '';
		foreach ($check_f1 as $item) {
			$listId .= ',' . $item['customer_id'];
		}
		$arrId = substr($listId, 1);
		// $arrId = explode(',', $arrId);
		$count = $this -> model_account_customer ->  getCustomer_ML($customer_id);

		if(intval($count['left']) === 0){
			$customer_binary = ',0';
		}else{
			$id = $count['left'];
			$count = $this -> model_account_customer -> getCount_ID_BinaryTreeCustom($count['left']);
			$customer_binary = $count.','.$id;
		}
		$customer_binary = substr($customer_binary, 1);
		// $customer_binary = explode(',', $customer_binary);
		$array = $arrId.','.$customer_binary;
		$array = explode(',', $array);
		$array = array_count_values($array);
		$array = in_array(2, $array) ? 1 : 0;
		return $array;
	}


	public function randprofit($customer_id){
		$this->load->model('account/customer');
		$get_all_p_node = $this -> model_account_customer -> get_all_p_node($customer_id);
		$getCustomerCustom = $this -> model_account_customer -> get_position($customer_id);
		$level = $getCustomerCustom['position'];
		$amount = 0;

		if (count($get_all_p_node) > 0){
			foreach ($get_all_p_node as $key => $value) {
				if ($level > $value['position']){
					$percent = $level - $value['position'];
					$amount += $percent*$value['p_node_pd']/100;
				}
			}
		}
		return $amount/100000000;
	}

	public function RequestPDFinish(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllPD(7, 0, 2);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['filled']/100000000).' BTC</span>'.$value['username'].'</p>';
		}
		

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function viewBlogs(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/dashboard/dashboard.js');
			$self -> load -> model('simple_blog/article');
		};
		

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$data['language']= $getLanguage;
		$language = new Language($getLanguage);
		$language -> load('account/dashboard');
		
		$data['lang'] = $language -> data;

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model

		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}

		$data['base'] = $server;
		$data['self'] = $this;
			//method to call function

			!$this -> request -> get['token']  && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
			$id_ = $this -> request -> get['token'];

if ($getLanguage == 'vietnamese') {
			$Language_id = 2;
		}else{
			$Language_id = 1;
		}
			$this->load->model('simple_blog/article');
			$data['detail_articles'] = $this->model_simple_blog_article->getArticlesBlogs($id_, $Language_id);        	
		
			if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/showblog.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/showblog.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/showblog.tpl', $data));
		}
		}

	public function changeLange(){
		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');
			$json['success'] = $this -> model_account_customer -> updateLanguage( $this -> session -> data['customer_id'], $this -> request -> get['lang'] ) ;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	/*
	 *
	 * ajax count total tree member
	 */
	public function totaltree() {
		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');
			$json['success'] = intval($this -> model_account_customer -> getCountTreeCustom($this -> session -> data['customer_id']));
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function total_binary_left($customer_id){
		$this -> load -> model('account/customer');

		$count = $this -> model_account_customer ->  getCustomer_ML($customer_id);
		if (count($count) > 0)
		{


			if(intval($count['left']) === 0){
				return 0;
			}else{
				$count = $this -> model_account_customer -> getCountBinaryTreeCustom($count['left']);
				$count = (intval($count) + 1);
				return $count;
			}
		}
		else
		{
			return 0;
		}

		

	}

	public function total_binary_right($customer_id){
		$this -> load -> model('account/customer');

		$count = $this -> model_account_customer ->  getCustomer_ML($customer_id);
		if (count($count) > 0)
		{

			if(intval($count['right']) === 0){
				return 0;
			}else{
				$count = $this -> model_account_customer -> getCountBinaryTreeCustom($count['right']);
				$count = (intval($count) + 1);
				return  $count;
			}
		}
		else
		{
			return 0;
		}
	}


	public function total_pd_left($customer_id){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($customer_id);
		if(intval($count['total_pd_left']) === 0){
			return 0;
		}else{
			return $count['total_pd_left'] / 10000;
		}

	}
	public function taidautu($customer_id){
		$this -> load -> model('account/customer');
		$checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($customer_id);


		if(intval($checkM_Wallet['number'])  === 0){
			if(!$this -> model_account_customer -> insert_M_Wallet($customer_id)){
				die();
			}
		}
		$total = $this -> model_account_customer -> get_M_Wallet($customer_id);
		$total = count($total) > 0 ? $total['amount'] : 0;
		
		$json['success'] = $total;
		$total = null;
		return round(($json['success']/100000000),8);
	}
	public function danhhieu($customer_id){
		$this -> load -> model('account/customer');
		$percent = "No level";
		$partent = $this -> model_account_customer -> getCustomer($customer_id);
		if (doubleval($partent['total_pd_node']) >= 50000000)
        {
            $percent = "Silver";
        }
        if (doubleval($partent['total_pd_node']) >= 150000000)
        {
            $percent = "Gold";
        }
        if (doubleval($partent['total_pd_node']) >= 500000000)
        {
            $percent = "Platinium";
        }
        if (doubleval($partent['total_pd_node']) >= 1000000000)
        {
            $percent = "Ruby";
        }
        if (doubleval($partent['total_pd_node']) >= 2000000000)
        {
            $percent = "Emeral";
        }
        if (doubleval($partent['total_pd_node']) >= 5000000000)
        {
            $percent = "Diamond";
        }
        if (doubleval($partent['total_pd_node']) >= 10000000000)
        {
            $percent = "Double Diamond";
        }
        if (doubleval($partent['total_pd_node']) >= 50000000000)
        {
            $percent = "Blue Diamond";
        }
        if (doubleval($partent['total_pd_node']) >= 100000000000)
        {
            $percent = "Black Diamond";
        }
        if (doubleval($partent['total_pd_node']) >= 200000000000)
        {
            $percent = "Crown Ambassador";
        }
        return $percent;

	}
	public function total_pd_right(){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($this -> session -> data['customer_id']);

		if(intval($count['total_pd_right']) === 0){
			return 0;
		}else{
			return round($count['total_pd_right'] / 100000000,8);

		}
		$this -> response -> setOutput(json_encode($json));
	}
	public function totalpin() {
		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');
			$pin = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);
			$pin = $pin['ping'];
			$json['success'] = intval($pin);
			$pin = null;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function analytics() {

		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');
			$json['success'] = intval($this -> model_account_customer -> getCountLevelCustom($this -> session -> data['customer_id'], $this -> request -> get['level']));
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function countPD($customer_id){
		
		$this -> load -> model('account/customer');

		$total = $this -> model_account_customer -> getTotalPD($customer_id);
		$total = $total['number'];
		return intval($total)/100000000;
		
	}


	public function countGD(){
		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');
			$total = $this -> model_account_customer -> getTotalGD($this -> session -> data['customer_id']);
			$total = $total['number'];
			$json['success'] = intval($total);
			$total = null;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function getR_Wallet_payment($customer_id){

		$this -> load -> model('account/customer');
		// $checkR_Wallet = $this -> model_account_customer -> checkR_Wallet($customer_id);
		// if(intval($checkR_Wallet['number'])  === 0){
		// 	if(!$this -> model_account_customer -> insertR_Wallet($customer_id)){
		// 		die();
		// 	}
		// }
	
		/*$getRwallet = $this -> model_account_customer -> getR_Wallet($customer_id);
		$getGDRecived = $this -> model_account_customer -> getTotalGD($customer_id);*/

		$total = $this -> model_account_customer -> getR_Wallet_payment($customer_id);
		//print_r($total); die;
		$total = count($total) > 0 ? $total['amount'] : 0;
		$json['success'] = $total;
		return round(($json['success']/100000000),8);
		

	}

	public function getCWallet($customer_id){

		$this -> load -> model('account/customer');

		$checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($customer_id);


		if(intval($checkC_Wallet['number'])  === 0){
			if(!$this -> model_account_customer -> insertC_Wallet($customer_id)){
				die();
			}
		}
		$total = $this -> model_account_customer -> getC_Wallet($customer_id);
		$total = count($total) > 0 ? $total['amount'] : 0;
		
		$json['success'] = $total;
		$total = null;
		return round(($json['success']/100000000),8);
		
		
	}
	public function getCNWallet($customer_id){
		$this -> load -> model('account/customer');
		$getCustomer = $this -> model_account_customer -> getCustomer($this->session->data['customer_id']);
		$getTotalPD = $this -> model_account_customer ->getTotalPD($this->session->data['customer_id']);
		
		if (doubleval($getCustomer['total_pd_left']) > doubleval($getCustomer['total_pd_right'])){
			 $balanced = doubleval($getCustomer['total_pd_right']);
		}
		else
		{
			$balanced = doubleval($getCustomer['total_pd_left']);
		}
			$precent = 10;
		
		$amount = ($balanced*$precent)/100;
		
		$json['success'] = $amount;
		return round(($json['success']/100000000),8);
	}
	public function getMWallet(){

		if ($this -> customer -> isLogged() && $this -> session -> data['customer_id']) {
			$this -> load -> model('account/customer');

			// $checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($this -> session -> data['customer_id']);
			// if(intval($checkM_Wallet['number'])  === 0){
			// 	if(!$this -> model_account_customer -> insert_M_Wallet($this -> session -> data['customer_id'])){
			// 		die();
			// 	}
			// }
			$total = $this -> model_account_customer -> get_M_Wallet($this -> session -> data['customer_id']);
			$total = count($total) > 0 ? $total['amount'] : 0;
			
			$json['success'] = $total;
			
			$total = null;
			$json['success'] = round(($json['success']/100000000),8);
			$this -> response -> setOutput(json_encode($json));
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
		$json['input_address'] = $package['input_address'];



		$json['amount'] =  $package['amount_inv'];
		$json['pin'] = $package['amount_inv'] - $package['pd_amount'];
		$json['package'] = $package['pd_amount'];
		$this->response->setOutput(json_encode($json));
	}


	/*-------------------------------------------------*/
	public function check_packet_pd_vnd($amount){
        $this -> load -> model('account/pd');
        $customer_id = $this -> session -> data['customer_id'];

        return $this -> model_account_pd -> check_packet_pd_vnd($customer_id, $amount);
    }

}
