<?php
class ControllerHomePage extends Controller {
	public function index() {
		
		$data['customer_get'] = array();

		if(isset($_COOKIE['customer_code'])) {
			$this -> load -> model('account/customer');
		    $data['customer_get'] = $this -> model_account_customer -> getCustomerbyCode($_COOKIE['customer_code']);
		}
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/home.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/home.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/home.tpl', $data));
		}
	}
	public function about() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/about.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/about.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/about.tpl', $data));
		}
	}
	public function contact() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/contact.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/contact.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/contact.tpl', $data));
		}
	}
	public function insights() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/insights.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/insights.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/insights.tpl', $data));
		}
	}
	public function investment() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/investment.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/investment.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/investment.tpl', $data));
		}
	}
	public function service() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/service.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/service.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/service.tpl', $data));
		}
	}
	public function news() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/new.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/new.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/new.tpl', $data));
		}
	}
	public function details() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/details.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/details.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/details.tpl', $data));
		}
	}
	public function terms() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		$this->document->setTitle("Terms and Conditions");

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/terms.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/terms.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/terms.tpl', $data));
		}
	}

	public function submit()
	{

		$cookie_name = "terms";
		$cookie_value = "terms";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 360), "/");
		
		header('Location: index.html');
	}

	public function header() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		$data['title'] = $this->document->getTitle();		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/home/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/home/header.tpl', $data);
		} else {
			return $this->load->view('default/template/home/header.tpl', $data);
		}
	}
	public function footer() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/home/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/home/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/home/footer.tpl', $data);
		}
	}
	public function sendMail(){
		if ($this -> request -> post) {

		// if ($_POST['capcha'] != $_SESSION['cap_code']) {
		// 		die('Error');
	 //    }
		$json = array();
	      $api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6Lcm_iIUAAAAAJGRhY09TEmAX01wTF3_8mkZRJQF';
		$secret_key  = '6Lcm_iIUAAAAAP_ps2_yc1d8gxJYx2yUVvDv7K6b';

		$site_key_post    = $_POST['g-recaptcha-response'];
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
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
	    }else{
	       $json['captcha'] = -1;
	    }
	    $json['success'] = -1;
	    // $json['captcha'] = 1;
	    if (intval($json['captcha']) === 1) {
	    $name = $this->request->post['fname'];
		$email = $this->request->post['email'];
		$subject = $this->request->post['subject'];
		$comments = $this->request->post['msg'];
		//$email = "mmo.hyipcent@gmail.com";
			$mail = new Mail();
				$mail -> protocol = $this -> config -> get('config_mail_protocol');
				$mail -> parameter = $this -> config -> get('config_mail_parameter');
				$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
				$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
				$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
				$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

				//$mail -> setTo($this -> config -> get('config_email'));
				$mail -> setTo('hgpn2017@gmail.com');
				$mail -> setFrom($this -> config -> get('config_email'));
				$mail -> setSender(html_entity_decode("TAV", ENT_QUOTES, 'UTF-8'));
				$mail -> setSubject("Support!");
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
				       	<p class="text-center" style="font-size:20px;color: black;text-transform: uppercase; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;">Support !<p>
				       	<p class="text-center" style="color: black; width:100%; float:left;text-align: center;line-height: 15px;margin-bottom:30px;"></p>
       	<div style="width:600px; margin:0 auto; font-size=15px">
       	<p style="font-size:14px;color: black;margin-left: 70px;">Email: <b>'.$name.'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Email: <b>'.$email.'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Subject: <b>'.$subject.'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Message: <b>'.$comments.'</b></p>
					      
					          </div>
				       </td>
				       </tr>
				    </tbody>
				    </table>
				  </div>';
				$mail -> setHtml($html_mail); 
				$mail -> send();
			$json['success'] = 1;
	    }
	    	
		
				
				
			$this->response->setOutput(json_encode($json));
			}
	}
	
}