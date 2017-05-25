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
	
}