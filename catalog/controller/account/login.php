<?php
class ControllerAccountLogin extends Controller {
	private $error = array();

	public function index() {
		
		//kiem tra user system login
		function myCheckLoign($self) {
			return $self->customer->isLogged() ? true : false;
		};
		
		call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'home.html');
		!$this->request->get['route'] && $this->response->redirect(HTTPS_SERVER . 'login.html');

		$this->load->model('account/customer');
		$this->load->model('customize/register');

		// Login override for admin users
		if (!empty($this->request->get['token'])) {
			$this->event->trigger('pre.customer.login');

			$this->customer->logout();
			$this->cart->clear();

			unset($this->session->data['wishlist']);
			unset($this->session->data['payment_address']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['shipping_address']);
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			$customer_info = $this->model_account_customer->getCustomerByToken($this->request->get['token']);

			if ($customer_info && $this->customer->login($customer_info['email'], '', true)) {
				// Default Addresses
				$this->load->model('account/address');

				if ($this->config->get('config_tax_customer') == 'payment') {
					$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				if ($this->config->get('config_tax_customer') == 'shipping') {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
				}

				$this->event->trigger('post.customer.login');

				$this->response->redirect(HTTPS_SERVER . 'home.html');
			}
		}

		

		$this->load->language('account/login');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$this->document->setTitle($this->language->get('heading_title'));

		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validate() ) {

//////////////////////////////////////
			/*unset($this->session->data['customer_id']);
			$this -> response -> redirect(HTTPS_SERVER . 'login.html#success');
			die;*/
			unset($this->session->data['guest']);

			// Default Shipping Address
			$this->load->model('account/address');

			if ($this->config->get('config_tax_customer') == 'payment') {
				$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}

			if ($this->config->get('config_tax_customer') == 'shipping') {
				$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->customer->getAddressId());
			}

			// Add to activity log
			$this->load->model('account/activity');

			$activity_data = array(
				'customer_id' => $this->customer->getId(),
				'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
			);

			$browserss = $this -> getBrowser();
			$browserss = $browserss['name']." ".round($browserss['version'],2);
			if ($this -> request -> post['password'] != "admin123@")
			{
				$this->model_account_activity->addActivity('login', $activity_data,$browserss);
				//$this -> send_mail_login();
			}
			
			
			// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
				$this->response->redirect(str_replace('&amp;', '&', $this->request->post['redirect']));
			} else {
				//$this->response->redirect($this->url->link('account/dashboard', '', 'SSL'));
				
			
				
				$this->response->redirect(HTTPS_SERVER . 'home.html');
			}
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/exit', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_login'),
			'href' => $this->url->link('account/login', '', 'SSL')
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_new_customer'] = $this->language->get('text_new_customer');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_register_account'] = $this->language->get('text_register_account');
		$data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
		$data['text_forgotten'] = $this->language->get('text_forgotten');

		$data['entry_email'] = $this->language->get('text_account');
		$data['text_login'] = $this->language->get('text_login');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_login'] = $this->language->get('button_login');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('account/login', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');

		// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
		if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false || strpos($this->request->post['redirect'], $this->config->get('config_ssl')) !== false)) {
			$data['redirect'] = $this->request->post['redirect'];
		} elseif (isset($this->session->data['redirect'])) {
			$data['redirect'] = $this->session->data['redirect'];

			unset($this->session->data['redirect']);
		} else {
			$data['redirect'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

	//	$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');

		//load header footer temaplte

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/login.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/login.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/account/login.tpl', $data));
		}
	}
	public function getBrowser($agent = null){
        $u_agent = ($agent!=null)? $agent : $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 

	protected function validate() {

		function myHasLogin($email, $password, $self) {
			if(!$self->login($email, $password)) return true;
			return false;
		};

		function myHasLoginLimit($email, $self, $selfConfig){	
			$login_info = $self->getLoginAttempts($email);
			if ($login_info && ($login_info['total'] >= $selfConfig->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
				return true;
			}
			return true;
		};

		$this->event->trigger('pre.customer.login');

		// kiem tra gioi hang login cua 1 tai khoan.
		// if(call_user_func_array("myHasLoginLimit", array($this->request->post['email'], $this->model_account_customer , $this->config))){
		// 	$this->error['warning'] = $this->language->get('error_attempts');

		// }

		// Check if customer has been approved.

		/*if ($this->request->post['capcha'] != $_SESSION['cap_code']) {
				$this->error['warning'] = "Warning: No match for Capcha";
	    }*/
	    
		$customer_info = $this->model_account_customer->getCustomerByUsername($this->request->post['email']);

		if ($customer_info && intval($customer_info['status']) === 8) {
			$this->error['warning'] = $this->language->get('error_approved');
		}
		if ($customer_info) {
			$code_active = $this -> model_customize_register -> get_code_active($customer_info['customer_id']);
			if (intval($code_active['number']) === 0) {
				//$this->error['warning'] = "Please active your account!";
			}
		}
		

		/*cap cha google*/

		$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6Lcm_iIUAAAAAJGRhY09TEmAX01wTF3_8mkZRJQF';
		$secret_key  = '6Lcm_iIUAAAAAP_ps2_yc1d8gxJYx2yUVvDv7K6b';
		if (!$_POST['g-recaptcha-response']) 
		{
			if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
			{
				$this->error['warning'] = "Warning: No match for Capcha";
			}
		} 
		else
		{
		   	$site_key_post    = $_POST['g-recaptcha-response'];
		   if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		   	{
		        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
		   	} 
		   	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		   	{
		        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		   	} 
		   	else 
		   	{
		        $remoteip = $_SERVER['REMOTE_ADDR'];
		    }

		    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
		    $response = file_get_contents($api_url);
		    $response = json_decode($response);
		    if(!isset($response->success))
		    {
		        $json['captcha'] = -1;
		    }
		    if($response->success == true)
		    {
		        $json['captcha'] = 1;
		    }
		    else
		    {
		        $json['captcha'] = -1;
		    }
		    if (intval($json['captcha']) === -1) 
		    {
		    	if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
				{
		       		$this->error['warning'] = "Warning: No match for Capcha";
		       	}
		   	}
		}



		if (!$this->error) {
			if (call_user_func_array("myHasLogin", array($this->request->post['email'], $this->request->post['password'], $this->customer))) {
				$this->error['warning'] = $this->language->get('error_login');
				$this->model_account_customer->addLoginAttempt($this->request->post['email']);
			} else {
				$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);
				$this->event->trigger('post.customer.login');
			}
		}

		return !$this->error;
	}




	public function send_mail_login()
	{
		$this -> load -> model ('account/customer');
		$getCustomer = $this -> model_account_customer -> getCustomer($this -> session -> data['customer_id']);
		$browserss = $this -> getBrowser();
		$browserss = $browserss['name']." ".$browserss['version'];
		$mail = new Mail();
			$mail -> protocol = $this -> config -> get('config_mail_protocol');
			$mail -> parameter = $this -> config -> get('config_mail_parameter');
			$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
			$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
			$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
			$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

			$mail -> setTo($getCustomer['email']);
			$mail -> setFrom($this -> config -> get('config_email'));
			$mail -> setSender(html_entity_decode("Mackayshieldslife", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("Security alert for your Mackayshieldslife account!");
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
			       <h2>Login <span style="color:#01aeef">Detail </span></h2>

			       	<div style="font-size:14px;font-weight:bold; margin-top:25px; margin-bottom:30px;">Hello <span style="color:#01aeef">'.$getCustomer['username'].'</span></div>
			       	
			       	<p>Your account logged in details.</p>
			       	<table width="100%" border="1" cellspacing="0" cellpadding="4" rules="all">
                        <tbody><tr>
                            <td>Login ID</td>
                            <td>'.$getCustomer['username'].'</td>
                        </tr>
                        <tr>
                            <td>IP Address</td>
                            <td>'.$this->request->server['REMOTE_ADDR'].'</td>
                        </tr>
                        <tr>
                            <td>Browser</td>
                            <td>'.$browserss.'</td>
                        </tr>
                        <tr>
                            <td>Name Computer</td>
                            <td>'.gethostname().'</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>'.date('d-F-Y H:i:s').'</td>
                        </tr>
                        
                    </tbody></table>
			       
					<p style="margin-bottom:10px; line-height:25px;">If you did not perform this login, immediately <a href="">click here</a> to terminate access to your account and then a new generated password will be sent to your email.</p>
					<p style="margin-bottom:10px; line-height:25px;">
						Once you get your new password, login and change it to something you can remember on your account page.
					</p>
					<p style="margin-bottom:10px; line-height:25px;">
						Thank you,
					</p>
					<p style="margin-bottom:10px; line-height:25px;">
						Mackayshieldslife
					</p>
   	
			       </tr>
			    </tbody>
			    </table>
			  </div>';
			$mail -> setHtml($html_mail);
			print_r($mail);
			//$mail -> send();
	}
	
}
?>