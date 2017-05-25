<?php
class ControllerAccountMessage extends Controller {

    public function index() {  

    	function myCheckLoign($self) {
            return $self->customer->isLogged() ? true : false;
        };

        function myConfig($self){
            
        };
        $data['self'] = $this;

        $this -> load -> model('account/customer');

        $data['customer'] = $this ->  model_account_customer -> getCustomer($this -> session -> data['customer_id']);

        //method to call function
        !call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
        call_user_func_array("myConfig", array($this));  

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/message.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/message.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/message.tpl', $data));
        }

    }
}