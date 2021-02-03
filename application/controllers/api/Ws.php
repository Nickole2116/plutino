<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

class Ws extends REST_Controller {
	
	var $key=API_P2P_KEY;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

	    $this->load->module("member_modules");
	    $this->load->module("package_modules");
	    $this->load->module("wallet_modules");
	    $this->load->module("share_modules");
	    // $this->load->module("country_modules");
	    // $this->load->module("bonus_modules");
	    
	    $this->output->enable_profiler(FALSE);
	    error_reporting(-1);
    }
	public function get_user_get()
	{
		exit;
		$this->get_user_post();
	}
    public function get_user_post()
    {

		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';
		 
        $member_id = $this->input->get_post('mid');
		$sign = $this->input->get_post('sign'); 

		if(!$member_id || !is_numeric($member_id) ){
		
			$data['err_code'] = 'INVALID_MID';
			$this->response($data,200);
		}else if(!$sign || $sign!= $this->verify_signature_get() )
		{
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
			
		}else{
			$user = $this->member_modules->api_get_member_detail();
			if(!$user){
				$data['err_code'] = 'MEMBER_NOT_FOUND';
				$this->response($data,200);
				
			}else{
				$data['status'] = 'ok';
				$data['data'] = $user; //only return important data
				$data['sign']= $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
				 
			}
		}
	}
	public function check_username_get()
	{
		exit;
		$this->check_username_post();
	}
    public function check_username_post()
    {
		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';
		 
        $member_username = $this->input->get_post('musername');
		$sign = $this->input->get_post('sign'); 

		if($member_username==''){
		
			$data['err_code'] = 'INVALID_MID';
			$this->response($data,200);
		}else if(!$sign || $sign!= $this->verify_signature_get() )
		{
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
			
		}else{
			$user = $this->member_modules->api_get_member_detail_by_username();
			if(!$user){
				$data['err_code'] = 'MEMBER_NOT_FOUND';
				$this->response($data,200);
				
			}else{
				$data['status'] = 'ok';
				$data['data'] = $user; //only return important data
				$data['sign']= $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
				 
			}
		}
	}  
	public function get_current_share_price_get()
	{
		exit;
		$this->get_current_share_price_post();
	}
    public function get_current_share_price_post()
    {
		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';
		 
        $member_id = $this->input->get_post('mid');
        $request_date = strtotime($this->input->get_post('mreqdate'));
		$sign = $this->input->get_post('sign'); 
		// if(!$member_id || !is_numeric($member_id) ){
		
		// 	$data['err_code'] = 'INVALID_MID';
		// 	$this->response($data,200);
		//} 
		if(!$sign || $sign!= $this->verify_signature_get() )
		{
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
			
		}else{
			$price = $this->share_modules->api_get_current_price();
			if(!$price){
				$data['err_code'] = 'MEMBER_NOT_FOUND';
				$this->response($data,200);
				
			}else{
				$data['status'] = 'ok';
				$data['data'] = $price; //only return important data
				$data['sign']= $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
				 
			}
		}
	} 

	function generate_signature($array, $key){

		ksort($array);
		$string = '';
		foreach($array as $akey=>$avalue){
			if($akey!='signatrue'){
				$string  .= urlencode($akey).urlencode($avalue);
			}
		}
		$hash = hash_hmac('sha1', $string, $key,true);
		$sign = base64_encode($hash);
		return $sign;
	}


	function verify_signature_get(){
		$data =$this->input->get();
		
		if(!$data){
			$data =$this->input->post();
		}		
		
		return $this->generate_signature($data, $this->key);
	
	}	

	public function generate_sign_testing_get() {
		echo $this->verify_signature_get();
	}

	public function check_login_get() {
		$this->check_login_post();
	}

	public function check_login_post() {
		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';

		$username = $this->input->get_post('musername');
		$password = $this->input->get_post('mpassword');
		$sign = $this->verify_signature_get();
         $req_date = strtotime($this->input->get_post('mreqdate'));
		 $current = strtotime(date('Y-m-d H:i:s'));

		if(!$username) {		
			$data['err_code'] = 'INVALID_USERNAME';
			$this->response($data,200);
		} else if(!$password) {		
			$data['err_code'] = 'INVALID_PASSWORD';
			$this->response($data,200);
		} else if(!$sign || $sign != $this->verify_signature_get()) {
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
		 } else if(!$req_date) {		
		 	$data['err_code'] = 'INVALID_REQ_DATE';
		 	$this->response($data,200);
		// } else if($req_date > $current) {		
		// 	$data['err_code'] = 'INVALID_REQ_DATE';
		// 	$this->response($data,200);
		// } else if(round(abs($current - $req_date)/60,2) > MERCHANT_PURCHASE_SESSION) {
		} else if(round(abs($current - $req_date)/3600,2) > 8) {
			$data['err_code'] = 'INVALID_SESSION';
			$this->response($data,200);
		} else {
			$userInfo = $this->member_modules->api_check_login();
               
            if($userInfo) {
            	$bal = $this->wallet_modules->api_get_balance($userInfo['member_id']);
            	$member_detail = $this->member_modules->api_get_member_ranking($userInfo['member_id']);
            	$rank = $member_detail['package_name'];
				$package_price = $member_detail['package_price'];
				// $grandpoint = 0;
				// $loyaltypoint = 0;
				$bc_credit = 0;

				if($bal['bc_credit']) {
					$bc_credit = $bal['bc_credit'];
				// } else {
				// 	$grandpoint = $bal['grand_point'];
				}

				// if(!$bal['loyalty_point']) {
				// 	$loyaltypoint = 0;
				// } else {
				// 	$loyaltypoint = $bal['loyalty_point'];
				// }

            	$user = array(
            			"mid"=> $userInfo['member_id'],
            			"musername" => $userInfo['member_username'],
            			"mrank" => $rank,
						"mcapital" => $package_price,
            			"memail" => $userInfo['member_email'],
            			"mbalance" => $bc_credit,
            			// "mbalance2" => $loyaltypoint,
            			"mreqdate" => $this->input->get_post('mreqdate')

            		);
				if($userInfo['member_detail_profile_image'])
					$user['mprofilepicture'] = AWS_FILE_URL.$userInfo['member_detail_profile_image'];
				else 
					$user['mprofilepicture'] = "";
					
				$data['status'] = 'ok';
				$data['data'] = $user;
				$data['sign'] = $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
            } else {
				$data['err_code'] = 'INVALID_LOGIN';
				$this->response($data,200);
            }

		}
	}

	public function get_member_balance_post() {
		$this->get_user_balance_post();
	}

	public function get_user_balance_post() {
		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';

        $member_id = $this->input->get_post('mid');
        $req_date = strtotime($this->input->get_post('mreqdate'));
		$sign = $this->verify_signature_get(); 
		$current = strtotime(date('Y-m-d H:i:s'));

		$get_detail = $this->wallet_modules->api_check_user();

		if(!$member_id) {		
			$data['err_code'] = 'INVALID_MEMBER_ID';
			$this->response($data,200);
		} else if (!$get_detail) {
			$data['err_code'] = 'INVALID_MEMBER_ID';
			$this->response($data,200);
		 } else if(!$req_date) {		
		 	$data['err_code'] = 'INVALID_REQ_DATE';
		 	$this->response($data,200);
		// } else if($req_date > $current) {		
		// 	$data['err_code'] = 'INVALID_REQ_DATE';
		// 	$this->response($data,200);
		// } else if(round(abs($current - $req_date)/60,2) > MERCHANT_PURCHASE_SESSION) {
		} else if(round(abs($current - $req_date)/3600,2) > 8) {
			$data['err_code'] = 'INVALID_SESSION';
			$this->response($data,200);
		} else if(!$sign || $sign != $this->verify_signature_get()) {
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
		} else {
			$bal = $this->wallet_modules->api_get_balance($member_id);

			$bc_credit = 0;

			if($bal['bc_credit']) {
				$bc_credit = $bal['bc_credit'];
			}

            $balance = array(

            		"mid"=> $member_id,
            		"mbalance" => $bc_credit,
            		"mreqdate" => $this->input->get_post('mreqdate'),

            	);

			$data['status'] = 'ok';
			$data['data'] = $balance;
			$data['sign'] = $this->generate_signature($data['data'], $this->key);	
			$this->response($data,200);
		}

	}
	public function transfer_point_get() {
		exit;
		$this->transfer_point_post();
	}
	/*vartek p2p */
	public function transfer_point_post() {
		$data = array();
		// $data['status'] = 'error';
		$data['code'] =''; 
		$data['message']= '';

		$order_id = $this->input->post('orderid');
        $musername = $this->input->post('username');
        $order_amount = $this->input->post('amount');
        $randomStr = $this->input->post('randomStr');
        $remark = $this->input->post('remark');
        $req_date = $this->input->post('timeStamp');
		$sign = $this->generate_signature($this->input->post(), $this->key);	
		$current = strtotime(date('Y-m-d H:i:s'));

		$get_detail = $this->wallet_modules->api_check_user($musername);
		
		if(!$randomStr) {
			$data['message'] = 'INVALID_RANDOM_STR';
			$data['code'] = '500';
			$this->response($data,200);
		} else if(!$order_id) {
			$data['message'] = 'INVALID_ORDER_ID';
			$data['code'] = '500';
			$this->response($data,200);
		}
		else if(!$order_amount) {
			$data['message'] = 'INVALID_ORDER_AMOUNT';
			$data['code'] = '500';
			$this->response($data,200);
		} else if(!$musername) {		
			$data['message'] = 'INVALID_MEMBER_NAME';
			$data['code'] = '500';
			$this->response($data,200);
		} else if (!$get_detail) {
			$data['message'] = 'INVALID_MEMBER_ID';
			$data['code'] = '500';
			$this->response($data,200);
		} else if(!$req_date) {		
		 	$data['message'] = 'INVALID_REQ_DATE';
		 	$data['code'] = '500';
		 	$this->response($data,200);
		} else if(!$sign || $sign != $this->input->post('signatrue')) {
			$data['message'] = 'INVALID_SIGN';
			$data['code'] = '500';
			$this->response($data,200);
		} else {
			$chk_order = $this->wallet_modules->api_get_order($order_id);

			if($chk_order) {
				// if order id already exist in database
				$data['message'] = 'INVALID_ORDER_EXIST';
				$data['code'] = '500';
				$this->response($data,200);
				return 0;
			}
			if($order_amount <0){

				$data['message'] = 'INVALID_ORDER_AMOUNT';
				$data['code'] = '500';
				$this->response($data,200);
					return 0;
			} 
			else {
				
				$this->wallet_modules->member_id = $get_detail['member_id'];
				$this->wallet_modules->order_id = $order_id;
				$this->wallet_modules->order_amount = $order_amount;
				$this->wallet_modules->order_desc = "##{transfer_from}## ##{p2p_exchange}##".'('.$get_detail['member_username'].')';
				$this->wallet_modules->order_date = $req_date;
				$this->wallet_modules->trx_type = 1;
				$this->wallet_modules->trx_trxtype = 6;
				$trx_id = $this->wallet_modules->api_do_trx();

            	// $order = array(

            	// 	"trxid"=> $trx_id,
            	// 	"orderid"=> $order_id,
            	// );

				$data['code'] = '200';
				$data['message'] = 'success';
				// $data['data'] = $order;
				// $data['sign'] = $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
			}
			
		}

	}

	public function transaction_detail_post() {

		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';

        $order_id = $this->input->get_post('moid');
        $member_id = $this->input->get_post('mid');
        $req_date = strtotime($this->input->get_post('mreqdate'));
		$current = strtotime(date('Y-m-d H:i:s'));
		$sign = $this->verify_signature_get(); 

		$order = $this->wallet_modules->api_get_order($order_id);

		if(!$order_id) {
			$data['err_code'] = 'INVALID_ORDER_ID';
			$this->response($data,200);
		} else if(!$order) {
			$data['err_code'] = 'INVALID_ORDER_ID';
			$this->response($data,200);
		} else if(!$member_id) {		
			$data['err_code'] = 'INVALID_MEMBER_ID';
			$this->response($data,200);
		} else if($order && $member_id != $order['member_wallet_trx_memberid']) {		
			$data['err_code'] = 'INVALID_MEMBER_ID';
			$this->response($data,200);
		} else if(!$req_date) {		
		 	$data['err_code'] = 'INVALID_REQ_DATE';
		 	$this->response($data,200);
		// } else if($req_date > $current) {		
		// 	$data['err_code'] = 'INVALID_REQ_DATE';
		// 	$this->response($data,200);
		// } else if(round(abs($current - $req_date)/60,2) > MERCHANT_PURCHASE_SESSION) {
		} else if(round(abs($current - $req_date)/3600,2) > 8) {
			$data['err_code'] = 'INVALID_SESSION';
			$this->response($data,200);
		} else if(!$sign || $sign != $this->verify_signature_get()) {
			$data['err_code'] = 'INVALID_SIGN';
			$this->response($data,200);
		} else {
            $rec = array(

            	"mid"=> $order['member_wallet_trx_memberid'],
            	"moid"=> $order['member_wallet_trx_orderid'],
			    "moamnt" => $order['member_wallet_trx_amount']*-1,
			    "mostatus" => 'Successful',
            	"mreqdate" => $this->input->get_post('mreqdate')

            );

			$data['status'] = 'ok';
			$data['data'] = $rec;
			$data['sign'] = $this->generate_signature($data['data'], $this->key);	
			$this->response($data,200);
		}
	}

	public function transaction_refund_post() {

		// no refund after 24 hours
		// no order id
		// not matching amount
		// member not match

		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';

        $order_id = $this->input->get_post('moid');
        $order_amount = $this->input->get_post('moamnt');
        $order_desc = $this->input->get_post('modesc');
        $member_id = $this->input->get_post('mid');
        $merchant_name = $this->input->post('mname');
		$sign = $this->verify_signature_get(); 
        $req_date = strtotime($this->input->get_post('mreqdate'));
		$current = strtotime(date('Y-m-d H:i:s'));

		if(!$order_id) {
			$data['err_code'] = 'INVALID_ORDER_ID';
			$this->response($data,200);
		} else {
			$refund = $this->wallet_modules->api_check_refund($order_id);
			$order = $this->wallet_modules->api_get_order($order_id);

			if($order) {
				$wallet_type = $order['member_wallet_trx_type'];
			}

			if($refund) {
				$data['err_code'] = 'INVALID_REFUND_EXIST';
				$this->response($data,200);
			} else if(!$order) {
				$data['err_code'] = 'INVALID_ORDER_ID';
				$this->response($data,200);
			} else if(!$order_amount) {
				$data['err_code'] = 'INVALID_ORDER_AMOUNT';
				$this->response($data,200);
			} else if($order && $order_amount != ($order['member_wallet_trx_amount']*-1)) {
				$data['err_code'] = 'INVALID_ORDER_AMOUNT';
				$this->response($data,200);
			} else if(!$member_id) {		
				$data['err_code'] = 'INVALID_MEMBER_ID';
				$this->response($data,200);
			} else if($order && $member_id != $order['member_wallet_trx_memberid']) {		
				$data['err_code'] = 'INVALID_MEMBER_ID';
				$this->response($data,200);
			} else if($order && ((strtotime(date('Y-m-d H:i:s'))-strtotime($order['member_wallet_trx_pos_date']))/(60*60))>24) {	
				$data['err_code'] = 'INVALID_REFUND_PERIOD';
				$this->response($data,200);
			} else if(!$req_date) {		
			 	$data['err_code'] = 'INVALID_REQ_DATE';
			 	$this->response($data,200);
			// } else if($req_date > $current) {		
			// 	$data['err_code'] = 'INVALID_REQ_DATE';
			// 	$this->response($data,200);
			// } else if(round(abs($current - $req_date)/60,2) > MERCHANT_PURCHASE_SESSION) {
			} else if(round(abs($current - $req_date)/3600,2) > 8) {
				$data['err_code'] = 'INVALID_SESSION';
				$this->response($data,200);
			} else if(!$sign || $sign != $this->verify_signature_get()) {
				$data['err_code'] = 'INVALID_SIGN';
				$this->response($data,200);
			}elseif($order_amount < 0){
				$data['err_code'] = 'INVALID_ORDER_AMOUNT';
				$this->response($data,200);
			} else {
				$this->wallet_modules->member_id = $member_id;
				$this->wallet_modules->order_id = $order_id;
				$this->wallet_modules->order_amount = $order_amount;
				$this->wallet_modules->order_desc = '##{merchant_refund}## '.'('.'##{merchant_name}## : '.$merchant_name.')</br>'.$order_desc;
				$this->wallet_modules->order_date = $this->input->get_post('mreqdate');
				$this->wallet_modules->member_wallet_trx_type = $wallet_type;
				$this->wallet_modules->trx_trxtype = 19;
				$trx_id = $this->wallet_modules->api_do_trx();

	            $order_return = array(

	            	"mid"=> $order['member_wallet_trx_memberid'],
	            	"moid"=> $order['member_wallet_trx_orderid'],
				    "mrfamnt" => $order_amount,
				    "mrfdate" => $req_date,

	            );

				$data['status'] = 'ok';
				$data['data'] = $order_return;
				$data['sign'] = $this->generate_signature($data['data'], $this->key);	
				$this->response($data,200);
			}
		}
	}
	public function validate_security_pin_post(){
		$data = array();
		$data['status'] = 'error';
		$data['err_code'] =''; 
		$data['err_message']= '';

        $member_id = $this->input->post('mid');
        $pin = $this->input->post('mpin');
		$sign = $this->verify_signature_get(); 
		$current = strtotime(date('Y-m-d H:i:s'));
        $req_date = strtotime($this->input->get_post('mreqdate'));

		$get_detail = $this->wallet_modules->api_check_user();

		if(!$member_id) {		
			$data['err_code'] = 'INVALID_MEMBER_ID';
		} else if (!$get_detail) {
			$data['err_code'] = 'INVALID_MEMBER_ID';
		} else if (!$pin) {
			$data['err_code'] = 'INVALID_SECURITY_PIN';
			$this->response($data,200);
		} else if ($get_detail && $get_detail['member_security_pin'] != md5($pin.$get_detail['member_password_salt'])) {
			$data['err_code'] = 'INVALID_SECURITY_PIN';
		} else if(!$req_date) {		
		 	$data['err_code'] = 'INVALID_REQ_DATE';
		 	$this->response($data,200);
		// } else if($req_date > $current) {		
		// 	$data['err_code'] = 'INVALID_REQ_DATE';
		// 	$this->response($data,200);
		// } else if(round(abs($current - $req_date)/60,2) > MERCHANT_PURCHASE_SESSION) {
		} else if(round(abs($current - $req_date)/3600,2) > 8) {
			$data['err_code'] = 'INVALID_SESSION';
		} else if(!$sign || $sign != $this->verify_signature_get()) {
			$data['err_code'] = 'INVALID_SIGN';
		} else{
		
		$data['status'] = 'ok';
		$data['data'] = array();
		$data['sign'] = $this->generate_signature($data['data'], $this->key);	
		}
		$this->response($data,200);
	}

}