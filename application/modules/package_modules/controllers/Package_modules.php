<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Package_modules extends MX_Controller
{

	 function __construct(){

		parent::__construct();
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->model("package_mobile","mobile");
		$this->load->model("member_mod","member");
		$this->form_validation->CI =& $this;

	}
	function validate_form($form){

		switch ($form) {
			case 'create':
 
				$this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|callback_check_duplicate_name');
				$this->form_validation->set_rules('package_price', 'Package Price', 'trim|required|is_numeric');	
				$this->form_validation->set_rules('package_share_percent', 'Package Share Percent', 'trim|required|is_numeric');
		
			break;

			case 'purchase':

			   	$this->form_validation->set_rules('txtAmount', 'Top Up Amount', 'trim|required|is_numeric');
				$this->form_validation->set_rules('selType', 'Network', 'required');	
				$this->form_validation->set_rules('txtEmail', 'Email Address', 'trim|required|valid_email');

			break;

			case 'purchase_ereload':
				$this->form_validation->set_rules('txtAmount_ere', 'Top Up Amount', 'trim|required|required|is_numeric');
				$this->form_validation->set_rules('selType_ere', 'Network', 'required');	
				$this->form_validation->set_rules('txtPhone_ere', 'Phone Number', 'required');
				$this->form_validation->set_rules('txtEmail_ere', 'Email Address', 'trim|required|valid_email');
				break;
		

			case 'update':

				$this->form_validation->set_rules('change_package_price', 'Package Price', 'trim|required|is_numeric');	
				$this->form_validation->set_rules('change_package_share_percent', 'Share Percent', 'trim|required|is_numeric');
			
			break;

			case 'upgrade_pacakge':

				$this->form_validation->set_rules('package_id','Package Type','trim|required|callback_check_balance');

				break;

				default:
			}
			 $this->form_validation->set_message('valid_email',$this->lang->line('error_msg_valid_email'));
			 $this->form_validation->set_message('is_numeric',$this->lang->line('error_msg_is_numeric'));
			 $this->form_validation->set_message('required', $this->lang->line('error_msg_required'));
			 $this->form_validation->set_message('max_length', $this->lang->line('error_msg_greater_than') );
	}
	function get()
	{
		$data ['start'] = $this->package->start = $this->input->get_post ( 'start' );
		if ($data ['start'] == '')
			$data ['start'] = $this->package->start = 0;
		$additional_variable="";
		$additional_variable .='&search_start_date='. $this->input->get_post("search_start_date");
		$additional_variable .='&search_end_date='. $this->input->get_post("search_end_date");
		$additional_variable .='&search_title='. $this->input->get_post("search_title");

		$page = $this->input->get_post('page');
		$page = ($page-1);
		if($page<0){
			$page=0;
		}
		$offset = $page * PER_PAGE_LIMIT;

		$package_search = new $this->package();
		$package_search->offset = $offset;	
		if ($this->input->get_post ( "search_start_date" )) {
			$package_search->search_start_date =  $this->input->get_post('search_start_date');
		} 
		else{
			$package_search->search_start_date = "";
		}

		if ($this->input->get_post ( "search_end_date" )) {
			$package_search->search_end_date =  $this->input->get_post('search_end_date');
		} 
		else{
			$package_search->search_end_date = "";
		}

		if ($this->input->get_post ( "search_title" )) {
			$package_search->search_title = $this->input->get_post('search_title');
		} 
		else{
			$package_search->search_title = "";
		}
	
		$package_show=$package_search->all(PER_PAGE_LIMIT);
        $total_rows = $package_search->count();  

        $data['package_show'] = $package_show; 
		$data['total_rows'] = $total_rows;
		$data['offset'] = $offset;
		$data['additional_variable'] =$additional_variable;

		return $data;
	}
	function get_payment_type_list($type=1)
	{
		$mobile = new $this->mobile();
		$mobile->payment_type_type = $type;
		return $mobile->get_payment_type_list();
	}
	function get_bank_code_list()
	{
		$mobile = new $this->mobile();
		return $mobile->get_bank_code_list();
	}
    function create_random_customer_username()
    {
     	$random_num = 'CUST'.random_string('numeric',3);
      	return $random_num;
    }
    function get_random_username()
    {
    	$mobile = new $this->mobile();
		$random_username = $this->create_random_customer_username();
		$mobile->order_payment_customer_no = $random_username;
		$member_username_valid = $mobile->check_random_customer_name();
		
		if ($member_username_valid > 0)
		{
			redirect($this->get_random_username());
			
		}
		else
		{
			return $random_username;
		}
    }
	function fund_transfer()
	{
		$this->validate_form("purchase");
		if($this->form_validation->run($this) == FALSE )
		{
			$data['error'] = 1;
			return $data;
		}else{

			$this->db->trans_begin();

			$memberid = $this->get_random_username();
			$amount = $this->input->post('txtAmount');
			$email = $this->input->post('txtEmail');
			$res = $this->input->post('txtPhone');
			$type = $this->encrypt->decode($this->input->post('selType'));
			$bank_selected = $this->input->post('bank_sel_softpins');


			$mobile = new $this->mobile();
			$mobile->order_payment_customer_no = $memberid;
			$mobile->order_payment_amount = $amount;
			$mobile->order_payment_type = $this->encrypt->decode($this->input->post('selType'));
			$mobile->order_payment_phone_mobile = $this->input->post('txtPhone');
			$mobile->order_payment_email = $this->input->post('txtEmail');
			$mobile->order_payment_usdt_address = "";
			$orderid= $mobile->create_order_payment_trx();
			if (!$orderid) {
				$this->db->trans_rollback();
				$data['error'] = 1;
				return $data;
			}
			$this->db->trans_commit();

			$mobile = new $this->mobile();
			$mobile->order_payment_id = $orderid;
			$invoice_no = $mobile->get_order_payment_byid();
			$banktypeid = $this->encrypt->decode($this->input->post('selTypeBank2'));


			$api_fund = $this->api_fund_transfer($memberid,$invoice_no['order_payment_trx_number'],$amount,$orderid,$banktypeid);
			
			//$this->sendmailer($email,$invoice_no['order_payment_trx_number'],$amount,$res,$type);
			// $this->session->set_flashdata('success', 'Create Successful'); 
			// $data['error']=0;
		}
		// return $data;
	}
	function fund_transfer_ereload()
	{
		$this->validate_form("purchase_ereload");
		if($this->form_validation->run($this) == FALSE )
		{
			$data['error'] = 1;
			return $data;
		}else{


			$this->db->trans_begin();

			$memberid = $this->get_random_username();
			$amount = $this->input->post('txtAmount_ere');
			$email = $this->input->post('txtEmail_ere');
			$phone = $this->input->post('txtPhone_ere');
			$type = $this->encrypt->decode($this->input->post('selTypeTwo'));
			$bank_selected = $this->input->post('bank_sel_ereload');


			//$this->sendmailer($email,1,$amount,$res,$type);


			$mobile = new $this->mobile();
			$mobile->order_payment_customer_no = $memberid;
			$mobile->order_payment_amount = $amount;
			$mobile->order_payment_type = $this->encrypt->decode($this->input->post('selTypeTwo'));
			$mobile->order_payment_phone_mobile = "";
			$mobile->order_payment_email = $this->input->post('txtEmailTwo');
			$mobile->order_payment_usdt_address = $this->input->post('txtUSDT');
			$orderid= $mobile->create_order_payment_trx();
			if (!$orderid) {
				$this->db->trans_rollback();
				$data['error'] = 1;
				return $data;
			}
			$this->db->trans_commit();

			$mobile = new $this->mobile();
			$mobile->order_payment_id = $orderid;
			$invoice_no = $mobile->get_order_payment_byid();
			$banktypeid = $this->encrypt->decode($this->input->post('selTypeBank'));

			$api_fund = $this->api_fund_transfer($memberid,$invoice_no['order_payment_trx_number'],$amount,$orderid,$banktypeid);
			// $this->session->set_flashdata('success', 'Create Successful'); 
			// $data['error']=0;
			//$this->sendmailer($email,$memberid,$amount,$res,$type);

		}
		// return $data;
	}
	function api_fund_transfer($memberid,$invoice_no,$amount,$orderid,$banktypeid)
	{
		$mobile = new $this->mobile();
		$clientip = $this->my_function->get_client_ip_address();
		//get the bank code id 
		
		//$bankarray = $mobile->get_bank_code_item($banktypeid);
		//receive the bank code data single list here (only bank code.)
		//$arr = json_decode($bankarray);

		$bankitem = $mobile->get_bank_code_item($banktypeid);
		$bankcode = $bankitem['bank_code_value'];




		$url = "https://pgw2.surepay88.com/fundtransfer";
        $sign = array(

        		"merchant"=>API_MERCHANT,
                "amount"=>$amount,
                "refid"=>$invoice_no,
                "customer"=>$memberid,
                "apikey"=>API_KEY,
                "currency"=>"MYR",
                "clientip"=>$clientip,
        );

        $token = $this->my_function->generate_signature($sign);
        //print_r($token);

        $arr = array(

        		"merchant"=>API_MERCHANT,
                "amount"=>$amount,
                "refid"=>$invoice_no,
                "customer"=>$memberid,
                "apikey"=>API_KEY,
                "currency"=>"MYR",
                "bankcode"=>$bankcode,
                "clientip"=>$clientip,
                "token"=>$token,
                "post_url"=>"https://".$_SERVER['SERVER_NAME']."/member/returnAPIURI/",
                "failed_return_url"=>"https://".$_SERVER['SERVER_NAME']."/member/fail_api/",
                "return_url"=>"https://".$_SERVER['SERVER_NAME']."/member/success_api/",
        );

        $param =  $arr;
       
        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = "";//$respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $orderid;
        $log->create_log_api();

		$sRequestURL = $url. '?' . http_build_query($param);
		$aFormParams = $param;
		$sHtml = $this->my_function->buildAutoSubmitForm($sRequestURL, 'POST', $aFormParams);
		echo $sHtml;
	}
	function returnAPIURI()
    {
        /*insert into logs*/
        $member = new $this->member();
        $rst = json_decode($_GET);
        if($rst['token']!='')
        {
            $member->log_api_token = $rst['token'];
            $getLog = $member->get_log_api_by_token();
            if(!$getLog)
            {
                $this->db->trans_rollback();
                $data['error'] = 1;
                return $data;
            }
            $member->log_api_respond = $_GET;
            $member->log_api_id = $getLog['log_api_id'];
            $member->update_log_api_respond_by_id();

            $mobile = new $this->mobile();
            $mobile->order_payment_id = $getLog['log_api_orderid'];
            $orderDetail = $mobile->get_order_payment_byid();
            if($rst['status']==1)
            {
            	$mobile->order_payment_status = 1;
            	$mobile->update_order_payment_status_by_id();

            	$this->sendmailer($orderDetail['order_payment_email'],$orderDetail['order_payment_trx_number'],$orderDetail['order_payment_amount'],$orderDetail['order_payment_phone_mobile'],$orderDetail['payment_type_value']);
            }else{

            	$mobile->order_payment_status = 9;
            	$mobile->update_order_payment_status_by_id();
            	$this->session->set_flashdata('error',1); 
            }
            $this->session->set_flashdata('success',1); 
           
        }else{
        	 $this->session->set_flashdata('error',1); 
        }
        redirect('member');
    }
	function check_status_transaction($token,$order_id)
	{
		$url = "https://pgw2.surepay88.com/transaction/status/";
		
        $arr = array(

                "token"=>$token
        );
        $param =  $arr;
        $respond = $this->my_function->curl($url,$param);
        $returnValue = json_encode($respond);
        
        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $order_id;
        $createLog = $log->create_log_api();
        if(!$createLog)
        {
        	return false;	
        }
        return true;
	}
	function sendmailer($email,$rec_num,$amount,$res,$type)
	{
		$rec = $rec_num;
		$amt = $amount;
		$resourc = $res;
		//$netwk = "";
		$lblres = "";

		$mobile = new $this->mobile();
		$netwkarray = $mobile->get_email_content_item($type);
		$netwk = $netwkarray['payment_type_value'];

		$resarray = $mobile->check_email_resource_type($type);
		$resour = $resarray['payment_type_type'];

		if($resour == "1")
		{
			$lblres = "Phone Number";

		}else if($resour == "2")
		{
			$lblres = "USDT Address";

		}else{
			$lblres = ""; 
		}

		$this->load->library('email');

		$config = array(

			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.zoho.com',
			'smtp_port' => 465,
			'smtp_user' => ADMIN_EMAIL,
			'smtp_pass' => 'Krypto123456*',
			'mailtype' => 'html',
			'newline' => "\r\n",
			'crlf' => "\r\n",
		);

		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$subject = "Receipt from Kryptonion ";
		$content = "<div style='background-color:#2ecc71;padding:5px;'><h3>&nbsp;&nbsp;ORDER #". $rec_num ."</h3></div><h4>Hi Admin, </h4><emp style='font-size:9px;'>&nbsp;&nbsp;Thank you for registering in Kryptonion, your reload has been confirmed!</emp><br><br><div style='width:100%;height:1.5px;background-color:#2ecc71;'></div><h6><b style='color:#2ecc71;'> ▶ </b>&nbsp;&nbsp;Receipt Number : ".$rec_num."</h6><h6><b style='color:#2ecc71;'> ▶</b>&nbsp;&nbsp; Amount : RM "
		           .$amount."</h6><h6><b style='color:#2ecc71;'>▶</b> &nbsp;&nbsp;" .$lblres. " : ".$res."</h6><h6><b style='color:#2ecc71;'>▶</b>&nbsp;&nbsp; Network : ".$netwk."</h6><br><div style='width:100%;height:1.5px;background-color:#2ecc71;'></div><small><em>Copyright @ Kryptonion Valley Sdn. Bhd. (202001015183 - 1371503-U)</em></small>";

		$this->email->to($email);
		$this->email->from(ADMIN_EMAIL,WEBSITE_NAME);
		$this->email->subject($subject);
		$this->email->message($content);

		if ($this->email->send()) {
        	echo 'Your email was sent, thanks.';
	    } else {
	        show_error($this->email->print_debugger());
	    }
	}


	function get_sales_report()
	{
		/*get from table */
		/* Data should be including no, order_payment_created_date, order_payment_type, order_payment_id, admin_name, 
		   order_payment_phone_number, order_payment_email, order_payment_usdt_address, order_payment_amount, order_payment_status */
		$data ['start'] = $this->mobile->start = $this->input->get_post ( 'start' );
		if ($data ['start'] == '')
			$data ['start'] = $this->mobile->start = 0;
		$additional_variable="";
		$additional_variable .='&search_start_date='. $this->input->get_post("search_start_date");
		$additional_variable .='&search_end_date='. $this->input->get_post("search_end_date");
		$additional_variable .='&search_trxno='. $this->input->get_post("search_trxno");
		
		$page = $this->input->get_post('page');
		$page = ($page-1);
		if($page<0){
			$page=0;
		}
		$offset = $page * PER_PAGE_LIMIT;

		$package_search = new $this->mobile();
		$package_search->offset = $offset;	
		if ($this->input->get_post ( "search_start_date" )) {
			$package_search->search_start_date =  $this->input->get_post('search_start_date');
		} 
		else{
			$package_search->search_start_date = "";
		}

		if ($this->input->get_post ( "search_end_date" )) {
			$package_search->search_end_date =  $this->input->get_post('search_end_date');
		} 
		else{
			$package_search->search_end_date = "";
		}

		if ($this->input->get_post ( "search_trxno" )) {
			$package_search->order_payment_trx_no = $this->input->get_post('search_trxno');
		} 
		else{
			$package_search->order_payment_trx_no = "";
		}
		$package_show=$package_search->all_for_sales(PER_PAGE_LIMIT);
        $total_rows = $package_search->count_for_sales();  

        $data['package_show'] = $package_show; 
		$data['total_rows'] = $total_rows;
		$data['offset'] = $offset;
		$data['additional_variable'] =$additional_variable;

		return $data;
	}
	function api_check_balance()
	{
		
		if(ENVIRONMENT =='production'){
      		
      		$url = MCASH_API_URL_LIVE."backend/getMerchantBalance";
			$merchant = MCASH_API_MERCHANT_LIVE; 
			$merchant_key = MCASH_API_KEY_LIVE;	
		}else{
			$url = MCASH_API_URL."backend/getMerchantBalance";
			$merchant = MCASH_API_MERCHANT; 
			$merchant_key = MCASH_API_KEY;	
		}
        $sign = $merchant.$merchant_key;
        
        $token = $this->my_function->signature($sign);
        $arr = array(

        		"merchant"=>$merchant,
                "hash"=>$token
        );
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
        $returnValue = json_encode($respond);
        print_r($returnValue);
	}
	function api_airtime_bill()
	{
  		$url = MCASH_API_URL_LIVE."service_api/transaction_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$product_name = "CELCOM_BILL";
		$account_no = '0123456789';
		$amount = 1;
		$trxid = "100009934";
		$reference = "Celcom bill Testing";
		$msisdn = "0123456789";
		$type = "bill";
        $sign = $merchant_key.$type.$product_name.$amount.$trxid.$account_no.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "type"=>$type,
                "trx_id"=>$trxid,
                "product_name"=>$product_name,
                "account_no"=>$account_no,
                "reference"=>$reference,
                "msisdn"=>$msisdn,
                "amount"=>$amount,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       	$returncode = $returnValue['code'];
       	if($returncode=="1")
       	{
       		$resultnumber = $returnValue['requestNo'];
       	}else{
       		$resultnumber = 0;
       	}

        $this->db->trans_begin();

        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $trxid;
        $log->log_api_result_number = $resultnumber;
        $create_log = $log->create_log_api();
        if(!$create_log){

        	$this->db->trans_rollback();
        }
        $this->db->trans_commit();
        return true;
	}
	function api_check_transaction_status(){

		$url = MCASH_API_URL_LIVE."service_api/getStatus_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$trxid = "100009934";
		$type = "bill";//airtime/bill
		$requestNo = "0";
		$type = "bill";
        $sign = $merchant_key.$type.$trxid.$requestNo.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "action"=>"getStatus",
                "trx_id"=>$trxid,
                "type"=>$type,
                "requestNo"=>$requestNo,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       	print_r($returnValue);
	}
	function api_airtime_ereload()
	{
		$url = MCASH_API_URL_LIVE."service_api/transaction_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$product_name = "DIGI";
		$pinless = 1;
		$trxid = "10000113";
		$msisdn = "0123456789";
		$deno = 5;
		$type = "airtime";//ereload
        $sign = $merchant_key.$type.$product_name.$deno.$pinless.$trxid.$msisdn.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "type"=>$type,
                "trx_id"=>$trxid,
                "product_name"=>$product_name,
                "deno"=>$deno,
                "msisdn"=>$msisdn,
                "pinless"=>$pinless,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       
       	$returncode = $returnValue['code'];
       	if($returncode=="1")
       	{
       		$resultnumber = $returnValue['data']['requestNo'];
       	}else{
       		$resultnumber = 0;
       	}
        $this->db->trans_begin();

        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $trxid;
        $log->log_api_result_number = $resultnumber;
        $create_log = $log->create_log_api();
        if(!$create_log){

        	$this->db->trans_rollback();
        }
        $this->db->trans_commit();
        return true;
	}
	function api_airtime_softpin()
	{
		$url = MCASH_API_URL_LIVE."service_api/transaction_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$product_name = "DIGI_PIN";
		$pinless = 0;//For softpin, pinless must always set to 0
		$trxid = "10000114";
		$qty = 1;
		$deno = 5;
		$type = "airtime";//airtime/games/others
        $sign = $merchant_key.$type.$product_name.$deno.$pinless.$trxid.$qty.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "type"=>$type,
                "trx_id"=>$trxid,
                "product_name"=>$product_name,
                "deno"=>$deno,
                "qty"=>$qty,
                "pinless"=>$pinless,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       
       	$returncode = $returnValue['code'];
       	if($returncode=="1")
       	{
       		$resultnumber = $returnValue['data']['requestNo'];
       	}else{
       		$resultnumber = 0;
       	}
        $this->db->trans_begin();

        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $trxid;
        $log->log_api_result_number = $resultnumber;
        $create_log = $log->create_log_api();
        if(!$create_log){

        	$this->db->trans_rollback();
        }
        /*softpin
			$returnValue['data']['softpin']['TopupCode'];
			$returnValue['data']['softpin']['TopupSerial'];
        */
        $this->db->trans_commit();
        return true;
	}
	function api_reload_evoucher(){

		$url = MCASH_API_URL_LIVE."service_api/transaction_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$product_name = "MCASH";
		$amount = 10;//Min 10
		$trxid = "T10000114";
		$type = "mcashevoucher";
        $sign = $merchant_key.$type.$product_name.$amount.$trxid.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "type"=>$type,
                "trx_id"=>$trxid,
                "product_name"=>$product_name,
                "amount"=>$amount,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       
       	$returncode = $returnValue['code'];
       	if($returncode=="1")
       	{
       		$resultnumber = $returnValue['data']['pin'];
       	}else{
       		$resultnumber = 0;
       	}
        $this->db->trans_begin();

        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $trxid;
        $log->log_api_result_number = $resultnumber;
        $create_log = $log->create_log_api();
        if(!$create_log){

        	$this->db->trans_rollback();
        }
        $this->db->trans_commit();
        return true;
	}
	function api_reload_mobile(){

		$url = MCASH_API_URL_LIVE."service_api/transaction_v02";
		$merchant = MCASH_API_MERCHANT_LIVE; 
		$merchant_key = MCASH_API_KEY_LIVE;	
		
		$product_name = "MCASH";
		$amount = 10;//Min 10
		$trxid = "T10000115";
		$type = "mcashereload";
		$hp = "60123456789";//User mobile number register with MCash

        $sign = $merchant_key.$type.$product_name.$amount.$trxid.$hp.$merchant;
        $token = $this->my_function->signature($sign);
      
        $arr = array(

        		"merchant"=>$merchant,
                "type"=>$type,
                "product_name"=>$product_name,
                "amount"=>$amount,
                "trx_id"=>$trxid,
                "hp"=>$hp,
                "hash"=>$token
        );
       
        $param =  $arr;
       	$respond = $this->my_function->curl($url,$param);
       	$returnValue = json_decode($respond, true);
       
       	$returncode = $returnValue['code'];
       	if($returncode=="1")
       	{
       		$resultnumber = $returnValue['data']['trx_id'];
       	}else{
       		$resultnumber = 0;
       	}
        $this->db->trans_begin();

        $log = new $this->member();
        $log->log_api_post = json_encode($param);
        $log->log_api_url = $url;
        $log->log_api_respond = $respond;
        $log->log_api_token = $token;
        $log->log_api_orderid = $trxid;
        $log->log_api_result_number = $resultnumber;
        $create_log = $log->create_log_api();
        if(!$create_log){

        	$this->db->trans_rollback();
        }
        $this->db->trans_commit();
        return true;
	}
}