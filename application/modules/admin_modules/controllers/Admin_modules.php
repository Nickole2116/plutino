<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Admin_modules extends MX_Controller
{

	 function __construct(){

		parent::__construct();
        $this->form_validation->CI =& $this;
		$this->load->model("admin_mod","admin");
	}

	function validate_form($form){

		switch ($form) {
			case 'create':
				
				$this->form_validation->set_rules('admin_name', lang('username'), 'trim|required|min_length[3]|max_length[14]|callback_check_alphanumeric|is_unique[admin.admin_name]');
				$this->form_validation->set_rules('admin_email', lang('email'), 'trim|required|min_length[6]|max_length[50]|valid_email');
				$this->form_validation->set_rules('admin_role', lang('role'), 'required');
				$this->form_validation->set_rules('admin_password', lang('password'), 'trim|required|min_length[6]');	
				$this->form_validation->set_rules('admin_confirm_password',lang('confirm_password'), 'trim|required|min_length[6]|matches[admin_password]');
				
	
				break;

			case 'login':
				
				$this->form_validation->set_rules('txt_admin_name', lang('username'), 'trim|required|min_length[3]|max_length[14]');
				$this->form_validation->set_rules('txt_admin_password', lang('password'),'trim|required|min_length[6]');

				break;

			case 'update':

				$this->form_validation->set_rules('change_admin_name', 'Name', 'trim|required|min_length[3]|max_length[14]|callback_check_admin');
				$this->form_validation->set_rules('change_admin_email', 'Email', 'trim|required|min_length[6]|max_length[50]|valid_email');
				$this->form_validation->set_rules('change_admin_role', 'Role', 'required');

				break;

			case 'update_password':

				$this->form_validation->set_rules('old_password','Current Password','trim|required|callback_check_password');
				$this->form_validation->set_rules('change_admin_password', 'Password', 'trim|required|min_length[6]');	
				$this->form_validation->set_rules('change_admin_confirm_password', 'Confirmed Password', 'trim|required|min_length[6]|matches[change_admin_password]');

				break;

			default:
		}
		$this->form_validation->set_message('valid_email',$this->lang->line('error_msg_valid_email'));
		$this->form_validation->set_message('is_numeric',$this->lang->line('error_msg_is_numeric'));
		$this->form_validation->set_message('required', $this->lang->line('error_msg_required'));
		$this->form_validation->set_message('max_length', $this->lang->line('error_msg_greater_than') );
	}
	/*function check_alphanumeric($str)
	{
		
		$str = $this->input->post("admin_name");
    	if(preg_match('/[^a-z_\-0-9]/i', $str)){
    		$this->form_validation->set_message('check_alphanumeric',lang('error_username'));
    		return false;	

    	}

    	
		return true;
	}
	
	function check_admin()
	{
		$admin = new $this->admin();
		$admin->admin_name = $this->input->post('change_admin_name');
		$admin_data = $admin->get_admin_name();

		$admin_id = $this->encrypt->decode($this->input->post('admin_id'));

		if($admin_data['admin_id'] == '')
		{
			return TRUE;
		}

		else if($admin_data['admin_id'] == $admin_id)
		{
			return TRUE;
		}

		else if($admin_data['admin_id'] != $admin_id)
		{
			$this->form_validation->set_message('check_admin', lang('error_username'));
			return FALSE;
		}
	}

	function check_password()
	{
		
		$data = array();
		$admin = new $this->admin();
		$old_password = $admin->old_password = $this->input->post('old_password');

		$admin->admin_id = $this->encrypt->decode($this->input->post('admin_id'));
		$admin_detail = $admin->get_detail();

		//check if security pin correct
		if($admin_detail['admin_password'] == md5($old_password.$admin_detail['admin_password_salt'])){
		//matched 
				return TRUE;
		}
		else{
				//return with error code
				$this->form_validation->set_message('check_password','Wrong Password');
				return FALSE;					
		}
	 
	} 
	function p_create() 
	{
		
		$data  = array();
		$data['error']=0;
		
		$admin = new $this->admin();

		$admin->admin_name = $this->input->post("admin_name");
		$admin->admin_email = $this->input->post("admin_email");
		$admin->admin_role = $this->input->post("admin_role");
		$admin->admin_password = $this->input->post("admin_password");
		

		 $this->validate_form("create");

		 if($this->form_validation->run($this) == FALSE){

		 	$data['error'] = 1;
		 	return $data;
		 	//echo validation_errors();
		 	
		 }
		 else{
		 	$admin_id = $admin->create_admin();
		 	$data['error'] = 0;
		 	return $data;
		 	//redirect(ADMINPATH.'/admin');

		 }


	}

	function get_listing(){
		$data ['start'] = $this->admin->start = $this->input->get_post ( 'start' );
		if ($data ['start'] == '')
			$data ['start'] = $this->admin->start = 0;
	   
			
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

		$admin_search = new $this->admin();
		$admin_search->offset = $offset;

		if ($this->input->get_post ( "search_start_date" )) {
			$admin_search->search_start_date = $this->input->get_post('search_start_date');
		} 
		else{
			$admin_search->search_start_date = "";
		}

		if ($this->input->get_post ( "search_end_date" )) {
			$admin_search->search_end_date = $this->input->get_post('search_end_date');
		} 
		else{
			$admin_search->search_end_date = "";
		}

		if ($this->input->get_post ( "search_title" )) {
			$admin_search->search_title = $this->input->get_post('search_title');
		} 
		else{
			$admin_search->search_title = "";
		}
			

		$admin_show=$admin_search->all(PER_PAGE_LIMIT);
        $total_rows = $admin_search->count();  

        $data['admin_show'] = $admin_show; 
		$data['total_rows'] = $total_rows;
		$data['offset'] = $offset;
		$data['additional_variable'] =$additional_variable;

		return $data;

		// $admin = $this->admin->get_listing();
		// return $admin;

	}

	function p_login(){

            $data  = array();
			$data['error']=0;
	
			$admin = new $this->admin();
			$admin->admin_name= $this->input->post("txt_admin_name");
			$admin->admin_password = $this->input->post("txt_admin_password");

			$this->validate_form("login");

            if($this->form_validation->run($this) == FALSE) {

             	//echo validation_errors();	

            }else{
               
               
                $userInfo = $admin->checkLogin();
                $this->db->last_query();
                if(!$userInfo || $userInfo['admin_status']!="1"){
                   	 $data['error']="Invalid Admin Name and Password";
                   	 //return $data;
                    //echo "Unsuccessful Login!!!!!!!!!!";
                    //redirect(ADMINPATH.'/login');
                    redirect(ADMINPATH.'/login?error=1');
                    
                }

                else{

                	//set session member detail
                	$this->session->set_userdata($userInfo);
					redirect(ADMINPATH.'/admin');
                }       
               
                
            }
            
    }


    function p_logout()
    {
        $this->session->unset_userdata('admin_id');
        redirect(ADMINPATH.'/login');
    } */


	/*function p_update(){


		$data  = array();
		$data['error']=0;
		
		$admin = new $this->admin();
		
			/* try to pass value by *//*
			$admin->admin_id = $this->encrypt->decode($this->input->post("admin_id"));
			$admin->admin_name = $this->input->post("change_admin_name");
			$admin->admin_email = $this->input->post("change_admin_email");
			$admin->admin_role = $this->input->post("change_admin_role");
	
			
		/* need to validate data before update*//*
		
		$this->validate_form("update");
			
			 if($this->form_validation->run($this) == FALSE){

			 	// $data['form'] = $this->form_value($member);
			 	$data['error'] = 1;
			 	//echo validation_errors();
			 }
			 /* if not error then update *//*
			 else{
	
				$this->db->trans_begin();

				$admin_id =$admin->update_admin_detail();
				

			if(!$admin_id){

					
					$this->db->trans_rollback();
					return false;
					
				}
				else
			 	{
			 		$this->db->trans_commit();
			 		//redirect(ADMINPATH.'/admin');
			 		//echo "yes";
					$this->session->set_flashdata('success', 'Update Successful');  //lang('update_successful')
					return $data;

			 	}

			}

	} 

	function p_update_status()
	{
		$admin = new $this->admin();

		$status = array('admin_status' => 0);
		$admin->admin_id = $this->encrypt->decode($this->input->post('admin_id'));
		$admin_status = $admin->update_status();
			
		redirect(ADMINPATH.'/admin');
	}


	function p_update_password(){

		$data = array();
		$admin = new $this->admin();
		
		// $admin->admin_id = $this->session->userdata('admin_id');
		$admin->admin_id = $this->encrypt->decode($this->input->post("admin_id"));
		$admin->admin_password = $this->input->post('change_admin_password');

		$this->validate_form("update_password");

		if($this->form_validation->run($this) == FALSE ){

			$data['error']='1';
			//echo validation_errors();

		}

		else{

			//update passsword

			$update_password = $admin->update_password();
			$this->session->set_flashdata('success', 'Update Password Successful');  //lang('update_password_successful')
		
			// echo '<script>alert("Succesfully Change Your Password!");</script>';
			// redirect(ADMINPATH.'/admin');
		
		}
			return $data;	
		
	}

	
    function get_ajax_result(){

    	$admin = new $this->admin();
		$admin->admin_id_ajax = $this->encrypt->decode($this->input->post('item_id'));
		$admin_ajax_result=$admin->get_ajax();	
		$row = $admin_ajax_result->row();
		echo $row->admin_name.'||'.$row->admin_email.'||'.$row->admin_role.'||';	

    }*/

}
?>
