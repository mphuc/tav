<?php
class ControllerAccountShare extends Controller {

    public function index() {  
        
    	function myCheckLoign($self) {
            return $self->customer->isLogged() ? true : false;
        };

        function myConfig($self){
            $self -> document -> addScript('catalog/view/javascript/Chart.bundle.js');
        };
        $data['self'] = $this;
        $this -> load -> model('account/customer');
        $data['getprice_share_all'] = $this -> model_account_customer -> getprice_share_all();

        $data['getprice_share_child'] = $this -> model_account_customer -> getprice_share_child();
        //method to call function
        $data['get_share_Wallet'] = $this -> model_account_customer -> get_share_Wallet($this -> session -> data['customer_id']);
        $data['histotys'] = $this -> model_account_customer -> histotys_share($this -> session -> data['customer_id']);

        $data['double_stock'] = $this -> model_account_customer -> get_history_stock($this-> session ->data['customer_id']);

        !call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
        call_user_func_array("myConfig", array($this));  

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/share.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/share.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/share.tpl', $data));
        }

    }

    // 45 tang %

    public function daypercent()
    {
        $this -> load -> model('account/customer');
        $getShare_child = $this -> model_account_customer -> getprice_share_child();
        if (count($getShare_child) == 0)
        {
            $cyr = 1;
            $price = 1000;
        }
        else
        {
            if ($getShare_child['price'] == 5000)
            {
                $price = 1000;
                $cyr = $getShare_child['cyrt'] + 1;
            }
            else
            {
                if (($getShare_child['price'] + 180) >= 5000)
                {
                    $cyr = $getShare_child['cyrt'];
                    $price = 5000;
                    $this -> nhandoi();
                }
                else
                {
                    $cyr = $getShare_child['cyrt'];
                    $price = $getShare_child['price'] + rand(100,140);
                }
            }
            
        }
        
        $this -> model_account_customer -> createprice_share($price, $cyr);

        $this -> active_share();
    }

    // active co phieu sau 45 ngay dau tu goi

    public function active_share()
    {
        $this -> load -> model('account/customer');
        $get_all_share = $this -> model_account_customer -> get_all_share();
        $getShare_child = $this -> model_account_customer -> getprice_share_child();
        foreach ($get_all_share as  $value) {
            $this -> model_account_customer -> UpdateShareActive($value['filled']*$getShare_child['price']/10000, $value['id']);
        }
        
    }

    // nhan doi khi gia = 0.5 USD

    public function nhandoi()
    {
        $this -> load -> model('account/customer');
        $get_all_share_active = $this -> model_account_customer -> get_all_share_active();
        foreach ($get_all_share_active as $value) {
            $this -> model_account_customer -> update_share_Wallet($value['amount']*2,$value['customer_id'],true);

            $get_share_Wallet = $this -> model_account_customer -> get_share_Wallet($value['customer_id']);

            $this -> model_account_customer -> saveTranstionHistory(
                $value['customer_id'], 
                "Duplicate stock", 
                "+ ".(number_format($value['amount']*2/10000))." USD", 
                "Multiply two stock ".(number_format($value['amount']/10000))." USD",
                1,
                $get_share_Wallet['amount']/10000, 
                $url = ''
            );

            $this -> model_account_customer -> UpdateSharenhandoi($value['id']);
        }
    }


    public function sell_share() {  
        
        function myCheckLoign($self) {
            return $self->customer->isLogged() ? true : false;
        };

        function myConfig($self){
            $self -> document -> addScript('catalog/view/javascript/share/share.js');
        };
        $data['self'] = $this;
        $this -> load -> model('account/customer');
        
        $data['get_share_Wallet'] = $this -> model_account_customer -> get_share_Wallet($this -> session -> data['customer_id']);

        $page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

        $limit = 10;
        $start = ($page - 1) * 10;

        $ts_history = $this -> model_account_customer -> getTotalHistory_stock($this -> session -> data['customer_id']);

        $ts_history = $ts_history['number'];

        $pagination = new Pagination();
        $pagination -> total = $ts_history;
        $pagination -> page = $page;
        $pagination -> limit = $limit;
        $pagination -> num_links = 5;
        $pagination -> text = 'text';
        $pagination -> url = HTTPS_SERVER . 'index.php?route=account/share/sell_share&page={page}';
        $data['histotys'] = $this -> model_account_customer -> getTransctionHistory_stock($this -> session -> data['customer_id'], $limit, $start);

        $data['pagination'] = $pagination -> render();

        !call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
        call_user_func_array("myConfig", array($this));  

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/share_sell.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/share_sell.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/share_sell.tpl', $data));
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
            $password_transaction = array_key_exists('password_transaction', $this -> request -> post) ? $_POST['password_transaction'] : "Error";
            if ($password_transaction == "Error" || $amount_usd == "Error") {
                return $json['error'] = -1;
            }
            $check_password_transaction = $this -> model_account_customer -> check_password_transaction($this->session->data['customer_id'],$password_transaction);

            if ($check_password_transaction > 0)
            {
                $count_withdraw_share = $this -> model_account_customer -> count_withdraw_share($this -> session -> data['customer_id']);
                if (intval($count_withdraw_share) == 0)
                {
                    $get_share_Wallet = $this -> model_account_customer -> get_share_Wallet($this -> session -> data['customer_id']);
                    if ($get_share_Wallet['amount'] >= $amount_usd*10000)
                    {
                        if ($get_share_Wallet['amount']*0.05 >= $amount_usd*10000)
                        {
                            $this -> model_account_customer -> update_share_Wallet($amount_usd*10000 , $this -> session -> data['customer_id'], false);

                             $get_share_Wallet = $this -> model_account_customer -> get_share_Wallet($this -> session -> data['customer_id']);

                            $this -> model_account_customer -> saveTranstionHistory_share(
                                $this -> session -> data['customer_id'], 
                                $amount_usd, 
                                "Sell stock ".(number_format($amount_usd))." USD",
                                $get_share_Wallet['amount']/10000
                            );
                            $json['complete'] = 1;
                        }
                        else
                        {
                            $json['percent'] = number_format($get_share_Wallet['amount']*0.05/10000);
                        }
                    }
                    else
                    {
                        $json['money_transfer'] = 1;
                    }
                }
                else
                {
                    $json['count_share'] = 1;
                }
            }
            else
            {
                $json['password'] = -1;
            }
            $this->response->setOutput(json_encode($json));
        }
    }

}