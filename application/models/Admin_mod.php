<?php

class Admin_mod extends CI_Model
{
	var $admin_id =0,
		$admin_name ="",
		$admin_email = "",
		$admin_role = "",
		$admin_password = "";


	
	/*function create_random_salt() {
    
	    $random = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	    // $random = uniqid(rand(), true);
	    return $random;
	}
	function create_admin()
	{
		$random = $this->create_random_salt();

		$this->load->helper('date');
		$data = array(
			"admin_name" =>$this->admin_name,
			"admin_email" =>$this->admin_email,
			"admin_role" =>$this->admin_role,
			"admin_password_salt"=> $random,
			"admin_password" => md5($this->admin_password.$random), 
			"admin_created_date" =>date('Y-m-d H:i:s', now()),
			);
	
		$this->db->insert("admin",$data);
		$admin_id = $this->db->insert_id();
		return $admin_id;
	
	}

	function get_listing()
	{
	
		$query = $this->db->get_where('admin',array('admin_status' => '1'));
		return $query->result_array();

	}
	function get_detail()
	{
		$this->db->where("admin_id", $this->admin_id);
		return $this->db->get("admin")->row_array();
	}

	function checkLogin(){
		
		
		$this->db->where('admin_name',$this->admin_name);
		$admin_detail = $this->db->get("admin")->row_array();

		if($admin_detail){
			if($admin_detail['admin_password'] == md5($this->admin_password.$admin_detail['admin_password_salt'])){
				
				return $admin_detail;

			}
			else{
				
				return false;
			}	
			
		}

		else{
			
			return false;
		}
	 
	
	
	}

	function get_admin_name()
	{
		$this->db->where('admin_name',$this->admin_name);
		return $this->db->get("admin")->row_array();
	}

	function update_admin_detail(){


		$data = array(
				
				"admin_name" => $this->admin_name,
				"admin_email" =>$this->admin_email,
				"admin_role" =>$this->admin_role

			);
			
			$admin_id = $this->db->where('admin_id',$this->admin_id);
			$this->db->update('admin',$data);
			

		return $admin_id;
	} 


	function update_password(){
		


		$this->db->where('admin_id',$this->admin_id);

		
		$admin_detail = $this->db->get("admin")->row_array('admin_password_salt');

		
		$data = array(
				"admin_password" => md5($this->admin_password.$admin_detail['admin_password_salt'])
			);

		$this->db->where('admin_id',$this->admin_id);
		$this->db->update('admin',$data);

		
	}

	function update_status()
	{

		$data = array('admin_status'=>0);
		$this->db->where('admin_id',$this->admin_id);
		$this->db->update('admin',$data);
		
	}


	function get_ajax(){
		

		return $this->db->get_where('admin',array('admin_id' => $this->admin_id_ajax));
		 
	}
	//pagination
	function all($limit = 0){
		//search option
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('admin_created_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('admin_created_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('admin_created_date <=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('admin_name', $this->search_title); 
		}
		$this->db->where('admin_status','1');
		$this->db->order_by('admin_created_date', 'DESC');
		$this->db->limit($limit);
		$this->db->offset($this->offset);
		$query = $this->db->get('admin');
		return $query->result_array();
	}

	function count(){
		//search option
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('admin_created_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('admin_created_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('admin_created_date <=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('admin_name', $this->search_title); 
		}
		$this->db->where('admin_status','1');
		return $this->db->count_all_results('admin');		
	}*/
}


