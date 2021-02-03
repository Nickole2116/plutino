<?php

class Package_mod extends CI_Model
{

	var $package_id =0,
		$package_name = "",
		$package_price = "",
		//$package_bv = "",
		$package_productid = "",
		$package_limit_upgrade_time ="",
		$package_maximum_pairing_bonus ="",
		$package_maximum_sponsor_bonus ="",
		$package_created_by ="",
		$package_created_date ="",
		$package_updated_by ="",
		$package_updated_date ="",
                $package_share_selling_limit ="",
		//$product_id = "",
		$package_status = 1,
		$register = 0,
		$is_admin =0;

	function get_detail()
	{
		$this->db->where("package_id", $this->package_id);
		$this->db->where("package_status",1);
		return $this->db->get("package")->row_array();
	}
	function get_detail_by_id()
	{
		return $this->db->query("SELECT *, 
							case when package_price = 0 then 
								(SELECT p2.package_price from package p2
								where p2.package_name = substr(p1.package_name,3) AND p2.package_status = 1  order by p2.package_price LIMIT 1)
							else package_price
							end as actual_package_price
							FROM package p1
							WHERE package_id = '".$this->package_id."'
							AND package_status = 1 ")->row_array();
	}
	function get_detail_by_result_array()
	{
		$this->db->where("package_status >", 0);
		// $this->db->where("package_id",$t)
		// $this->db->where("package_price >",0);
		// $this->db->order_by("package_price",'desc');
		return $this->db->get("package")->result_array();
	}
	function get_detail_by_price($is_freeAcc=0)
	{
		$this->db->where("package_status >", 0);
		// $this->db->where("package_id",$t)
		if($is_freeAcc ==1)
		{
			$this->db->where("package_price >=", $this->package_price);	
		}else{
			$this->db->where("package_price >", $this->package_price);
		}
		$this->db->where_not_in("package_price",0);
		$this->db->order_by('package_price','asc');
		return $this->db->get("package")->result_array();
	}
	function check_duplicate_name($package_name)
	{
		$this->db->where('package_name',$package_name);
		$query = $this->db->get_where('package',array('package_status' => '1'));

		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	function get_listing()
	{
		//$this->db->join("product", "product_id = package_productid", "left");
		$this->db->where('package_status','1');
		return $this->db->get('package')->result_array();
	}
	function get_current_package()
	{
		$this->db->where('package_status','1');
		$this->db->order_by('package_id','desc');
		return $this->db->get('package')->row_array();
	}
	function get_listing_for_sample($sort)
	{
		$this->db->where('package_status','1');
		$this->db->where('package_price >','0');
		$this->db->order_by('package_price', $sort);
		return $this->db->get('package')->result_array();
	}
	function create()   
	{
		$data = array(

				"package_name" =>$this->package_name,
				"package_price" =>$this->package_price,
				"package_share_percent" =>$this->package_share_percent,
				"package_created_date" =>date("Y-m-d H:i:s"),
				"package_created_by" =>$this->package_created_by,

			);

			$this->db->insert("package",$data);
			$package_id = $this->db->insert_id();
			
			return $package_id;
	}

	function update()
	{	
		$data = array(
				
			"package_name" =>$this->package_name,
			"package_price" =>$this->package_price,
			"package_share_percent" =>$this->package_share_percent,
			"package_updated_date" =>date("Y-m-d H:i:s"),
			"package_updated_by"=>$this->package_updated_by,
		);
		
		$this->db->where('package_id',$this->package_id);
		$this->db->update('package',$data);
	}
	//pagination
	public function all($limit = 0){
		//$this->db->join("product", "product_id = package_productid", "left");

		//search option
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('product_created_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('package_created_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('package_created_date>=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('package_name', $this->search_title); 
		}
		
		$this->db->where('package_status','1');
		$this->db->limit($limit);
		$this->db->offset($this->offset);
		$query = $this->db->get('package');
		return $query->result_array();
	}

	public function count(){
		//$this->db->join("product", "product_id = package_productid", "left");
		
		//search option
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('product_created_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if($this->search_start_date){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('package_created_date>=', $search_start_date);
		}
		if($this->search_end_date){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('package_created_date>=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('package_name', $this->search_title); 
		}
		$this->db->where('package_status','1');
		return $this->db->count_all_results('package');		
	}
	function get_ajax()
	{
        return $this->db->get_where('package',array('package_id' => $this->package_id_ajax));
	}
	function update_status($package_status,$package_id)
	{
		$data = array('package_status'=>0);
		$this->db->where('package_id',$package_id);
		$this->db->update('package',$data);
		
	}
	function get_packageid_by_memberid()
	{
		$this->db->where('m.member_id',$this->member_id);
		$this->db->join("package as p", "p.package_id = m.member_ranking", "left");
		return $this->db->get('member as m')->row_array();

	}
	function get_member_package_by_memberid()
	{
		$this->db->where('m.member_id',$this->member_id);
		$this->db->join("package as p", "p.package_id = m.member_packageid", "left");
		return $this->db->get('member as m')->row_array();
	}
	function get_like_name()
	{
		if($this->package_name)
		{
			$this->db->like('package_name', $this->package_name);
			return $this->db->get('package')->result_array();
		}
	}
	function get_detail_by_name()
	{
		$this->db->where('package_name',$this->package_name);
		$this->db->where('package_status',1);
		return $this->db->get('package')->row_array();
		
	}
	function get_test_data()
	{
		
		$this->db->query("SELECT * FROM mobile_package p1")->row_array();

		$this->db->where('package_name',"USD 750");
		$this->db->where('package_status','0');
		return $this->db->get('package')->row_array();

		//$this->db->where('package_status','1');
		//return $this->db->get('package')->result_array();

	}
}