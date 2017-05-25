<?php
class ControllerAccountSetting extends Controller {
	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model
		$this -> load -> model('customize/country');
		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}
		$this -> load -> language('account/setting');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		
		$language -> load('account/setting');
		$data['lang'] = $language -> data;

		$data['base'] = $server;
		$data['self'] = $this;
		$data['banks'] = $this -> model_account_customer -> getCustomerBank($this -> session -> data['customer_id']);
		$data['customer'] = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);
		$data['country'] = $this -> model_customize_country -> getCountry();

		$data['get_customer_setting'] = $get_customer_setting = $this -> model_account_customer -> get_customer_setting($this -> session -> data['customer_id']);


		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/setting.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/setting.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/setting.tpl', $data));
		}

	}
	public function password_login() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model
		$this -> load -> model('customize/country');
		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}
		$this -> load -> language('account/setting');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		
		$language -> load('account/setting');
		$data['lang'] = $language -> data;

		$data['base'] = $server;
		$data['self'] = $this;
		$data['banks'] = $this -> model_account_customer -> getCustomerBank($this -> session -> data['customer_id']);
		$data['customer'] = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);				

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/password_login.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/password_login.tpl', $data));
		} else {

			$this -> response -> setOutput($this -> load -> view('default/template/account/password_login.tpl', $data));
		}

	}
	public function password_transaction() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model
		$this -> load -> model('customize/country');
		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}
		$this -> load -> language('account/setting');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		
		$language -> load('account/setting');
		$data['lang'] = $language -> data;

		$data['base'] = $server;
		$data['self'] = $this;
		$data['banks'] = $this -> model_account_customer -> getCustomerBank($this -> session -> data['customer_id']);
		$data['customer'] = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);				

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/password_transaction.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/password_transaction.tpl', $data));
		} else {
			
			$this -> response -> setOutput($this -> load -> view('default/template/account/password_transaction.tpl', $data));
		}

	}
	public function wallet() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model
		$this -> load -> model('customize/country');
		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}
		$this -> load -> language('account/setting');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		
		$language -> load('account/setting');
		$data['lang'] = $language -> data;

		$data['base'] = $server;
		$data['self'] = $this;
		$data['banks'] = $this -> model_account_customer -> getCustomerBank($this -> session -> data['customer_id']);
		$data['customer'] = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);				

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/wallet.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/wallet.tpl', $data));
		} else {
			
			$this -> response -> setOutput($this -> load -> view('default/template/account/wallet.tpl', $data));
		}

	}

	public function editpasswd() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		if ($this -> request -> server['REQUEST_METHOD'] === 'POST') {
			$this -> load -> model('account/customer');

			$this -> model_account_customer -> editPasswordCustom($this -> request -> post['password']);

			$variableLink = HTTPS_SERVER.'change-login-password.html#success';

			$this -> response -> redirect($variableLink);
		}
	}

	public function edittransactionpasswd() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));
		if ($this -> request -> server['REQUEST_METHOD'] === 'POST') {
			$this -> load -> model('account/customer');

			$this -> model_account_customer -> editPasswordTransactionCustom($this -> request -> post['transaction_password']);
			$variableLink = HTTPS_SERVER.'your-profile.html#success';
			$this -> response -> redirect($variableLink);
		}
	}

	public function edit() {
		//not run for this function
		die();
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/setting/setting.js');
		};
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('/login.html'));
		call_user_func_array("myConfig", array($this));

		if ($this -> request -> server['REQUEST_METHOD'] === 'POST') {
			$this -> load -> model('account/customer');
			$this -> model_account_customer -> editCustomerCusotm($this -> request -> post);
			$variableLink = $this -> url -> link('account/setting', '', 'SSL') . '&success=account';
			$this -> response -> redirect($variableLink);
		}
	}

	public function account() {
		if ($this -> customer -> isLogged() && $this -> request -> get['id']) {
			$this -> load -> model('account/customer');
			$this -> response -> setOutput(json_encode($this -> model_account_customer -> getCustomerCustomFormSetting($this -> request -> get['id'])));
		}
	}

	public function banks() {
		if ($this -> customer -> isLogged() && $this -> request -> get['id']) {
			$this -> load -> model('account/customer');
			$this -> response -> setOutput(json_encode($this -> model_account_customer -> getCustomerBank($this -> request -> get['id'])));
		}
	}


	public function checkpasswdtransaction() {
		if ($this -> customer -> isLogged() && $this -> request -> get['pwtranction']) {
			$this -> load -> model('account/customer');
			$variable = $this -> model_account_customer -> getPasswdTransaction($this -> request -> get['pwtranction']);
			array_key_exists('number', $variable) && $this -> response -> setOutput(json_encode($variable['number']));
		}
	}

	public function checkpasswd() {
		if ($this -> customer -> isLogged() && $this -> request -> get['passwd']) {
			$this -> load -> model('account/customer');
			$variable = $this -> model_account_customer -> checkpasswd($this -> request -> get['passwd']);
			array_key_exists('number', $variable) && $this -> response -> setOutput(json_encode($variable['number']));
		}
	}

	public function updatewallet() {
		
		if ($this -> customer -> isLogged() && $this -> request -> post['wallet'] && $this -> request -> post['transaction_password']) {
			
			$json['login'] = $this -> customer -> isLogged() ? 1 : -1;
			$this -> load -> model('account/customer');
			$validate_address = $this -> check_address_btc($this -> request -> post['wallet']);
			if (intval($validate_address) === 1) {
				$json['wallet'] = 1;
			} else {
				$json['wallet'] = -1;
			}
			$variablePasswd = $this -> model_account_customer -> getPasswdTransaction($this -> request -> post['transaction_password']);
			$json['password'] = $variablePasswd['number'] === '0' ? -1 : 1;

			$json['complete'] = $json['login'] === 1 && $json['password'] === 1 && $json['wallet'] === 1 ? 1 : -1;
			$json['link'] = HTTPS_SERVER . 'index.php?route=account/setting#success';
			
			if ($json['login'] === 1 && $json['password'] === 1 && $json['wallet'] === 1)
			{
				$getCustomer = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);


				if ($getCustomer['wallet'] == "")
				{
					$this -> xml($this -> session -> data['customer_id'],$getCustomer['username'],$this -> request -> post['wallet']);
					$this -> model_account_customer -> editCustomerWallet($this -> request -> post['wallet']);
				}
		
			}	
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function xml($customer_id, $username, $wallet){
		
	   	$doc = new DOMDocument('1.0');
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
	   	$doc->load( 'qwrwqrgqUQadVbaWErqwre.xml' );
	   	$root = $doc->getElementsByTagName('wallet_payment')->item(0);

	   	$b = $doc->createElement( "customer" ); 

	   	$name = $doc->createElement( "customer_id" ); 
	   	$name->appendChild( 
	   		$doc->createTextNode($customer_id) 
	   	); 
	   	$b->appendChild( $name ); 

	   	$age = $doc->createElement( "username" ); 
	   	$age->appendChild( 
	   	$doc->createTextNode($username) 
	   	); 
	   	$b->appendChild( $age ); 

	   	$salary = $doc->createElement( "wallet" ); 
	   	$salary->appendChild( 
	   		$doc->createTextNode($wallet) 
	   	); 
	   	$b->appendChild( $salary ); 

	   	$root->appendChild( $b ); 
	   	$doc->save("qwrwqrgqUQadVbaWErqwre.xml") ;
	   
	}

	public function update_xml($customer_id, $wallet,$perfectmoney,$payeersss)
	{
		
		$file = "qwrwqrgqUQadVbaWErqwre.xml";

		$xml=simplexml_load_file($file);
		$i = -1;
		foreach ($xml->customer as $value) {
			$i = $i + 1;
			if  ($value->customer_id == $customer_id)
			{
				$getCustomer = $this -> model_account_customer -> getCustomer($customer_id);
				if ($getCustomer['wallet'] == "" && $wallet)
				{
					$value ->wallet[$i] = $wallet;
				}
				if ($getCustomer['perfect_money'] == "" && $perfectmoney)
				{
					$value ->perfect_money[$i] = $perfectmoney;
				}
				if ($getCustomer['payeer'] == "" && $payeersss)
				{
					$value ->payeer[$i] = $payeersss;
				}
			}
		}

		file_put_contents("qwrwqrgqUQadVbaWErqwre.xml", $xml -> saveXML());

	}

	
	 public function loadxml(){
	  $xml=simplexml_load_file("qwrwqrgqUQadVbaWErqwre.xml");
	
	 foreach($xml->children() as $child)
	   {
	   echo $child['customer_id']."<br>";
	   }
	 }

	public function updatebanks() {
		$this -> load -> model('account/customer');
		$banks = $this -> model_account_customer -> getCustomerBank($this -> session -> data['customer_id']);

		if($banks['account_holder'] || $banks['bank_name'] || $banks['account_number'] || $banks['branch_bank'] ) {
			die();
		}

		if ($this -> customer -> isLogged() && $this -> request -> get['account_holder'] && $this -> request -> get['bank_name'] && $this -> request -> get['account_number'] && $this -> request -> get['branch_bank']) {
			$json['login'] = $this -> customer -> isLogged() ? 1 : -1;
			
			
			$json['ok'] = $json['login'] === 1 ? 1 : -1;
			$data = array(
					'account_holder' => $this -> request -> get['account_holder'],
					'bank_name' => $this -> request -> get['bank_name'],
					'account_number' => $this -> request -> get['account_number'],
					'branch_bank' => $this -> request -> get['branch_bank'],
				);
			$json['login'] === 1 && $this -> model_account_customer -> editCustomerBanks($data);
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function update_profile(){
		if ($_POST)
		{
			$this -> load -> model('account/customer');
			if ($this -> customer -> isLogged()) {
				$getPasswdTransaction =  $this -> model_account_customer -> getPasswdTransaction($_POST['password_transaction']);
				if ($getPasswdTransaction['number'] > 0)
				{
					$this -> model_account_customer -> editCustomerProfile($_POST);
					$json['complete'] = 1;
				}
				else{
					$json['password'] = -1;
				}
				
				$this -> response -> setOutput(json_encode($json));
				
			}
		}
		
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
			$json['success'] = intval($this -> model_customize_register -> checkExitEmail($this -> request -> get['email'])) < 11 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function checkphone() {
		if ($this -> request -> get['phone']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitPhone($this -> request -> get['phone'])) < 11 ? 0 : 1;
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

    public function updateipaddress(){
    	if ($this -> request -> post['ip_address'])
    	{
    		$this -> load -> model ('account/customer');
    		$this -> model_account_customer -> update_customer_setting_ip($this -> request -> post['ip_address'],$this -> session -> data['customer_id']);
    		$json['complete'] = 1;
    		$this -> response -> setOutput(json_encode($json));
    	}
    }

    public function updateloginalerts(){

    	if ($this -> request -> post)
    	{
    		$this -> load -> model ('account/customer');
    		$this -> model_account_customer -> update_customer_setting_loginalerts($this -> request -> post['status'],$this -> session -> data['customer_id']);
    		$json['complete'] = 1;
    		$this -> response -> setOutput(json_encode($json));
    	}
    }

    public function updateauthenticator(){

    	if ($this -> request -> post)
    	{
    		$this -> load -> model ('account/customer');
    		$ga = new PHPGangsta_GoogleAuthenticator();

    		$oneCode = $ga->getCode($this -> request -> post['key_authenticator']);
    		if ($oneCode == $this -> request -> post['ip_authenticator'])
    		{
    			$this -> model_account_customer -> update_customer_setting_authenticator($this -> request -> post['status'],$this -> session -> data['customer_id']);
    			$json['complete'] = 1;
    			$this -> response -> setOutput(json_encode($json));
    		}
    		else
    		{
    			$json['authenticator'] = -1;
    			$this -> response -> setOutput(json_encode($json));
    		}

    		
    		
    	}
    }

    public function updateprofile(){

    	if ($this -> request -> files)
    	{
    		$this -> load -> model ('account/customer');
    			$file = $this -> avatar($this -> request -> files, $this -> session -> data['customer_id']);
    			$json['complete'] = 1;
    			$this -> response -> setOutput(json_encode($json));
    		
    	}
    }
    public function avatar($file,$cus_id){
		$this->load->model('account/customer');
		

		$imagename = $_FILES['avatar']['name'];
		$size = $_FILES['avatar']['size'];
		
		$ext = strtolower($this->getExtension($imagename));
		
		
		$actual_image_name = time().".".$ext;
		$uploadedfile = $_FILES['avatar']['tmp_name'];
		$path = "system/upload/";
		$newwidth = 200;
		$filename = $this -> compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);
		

		$server = $this -> request -> server['HTTPS'] ? $this -> config -> get('config_ssl') :  $this -> config -> get('config_url');
		
		$linkImage = $server.$filename;
		
		$this -> model_account_customer -> update_avatar($cus_id,$linkImage);

		
	}
	public function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i)
		{
		return "";
		}
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	public function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
	{

		if($ext=="jpg" || $ext=="jpeg" )
		{
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($ext=="png")
		{
		$src = imagecreatefrompng($uploadedfile);
		}
		else if($ext=="gif")
		{
		$src = imagecreatefromgif($uploadedfile);
		}
		else
		{
		$src = imagecreatefrombmp($uploadedfile);
		}

		list($width,$height)=getimagesize($uploadedfile);
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = $path.$newwidth.'_'.$actual_image_name.md5(mt_rand()); //PixelSize_TimeStamp.jpg
		imagejpeg($tmp,$filename,100);
		imagedestroy($tmp);
		return $filename;
		}
			
}
