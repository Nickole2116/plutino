<?php

class Member_mod extends CI_Model
{

	/*var $member_id =0,
		$member_username = "",
		$member_password = "",
		$member_security_pin = "",
		$member_email = "",
		$member_detail_fullname = "",
		$member_detail_ic_pas = "",
		$member_detail_phone = "",
		$member_detail_address = "",
		$member_detail_address_2 = "",
		$member_detail_city = "",
		$member_detail_postcode = "",
		$member_detail_state = "",
		$member_detail_country = "",
		$member_detail_beneficiary_name = "",
		$member_detail_beneficiary_fullname = "",
		$member_detail_beneficiary_ic = "",
		$member_detail_beneficiary_phone = "",
		$member_detail_register_remark = "",
		$member_packageid = "",
		$member_original_packageid = "",
		$member_rankingid = "",
		$sponsor_id = "",
		$placement_id = "",
		$placement_position = "",
		$member_placement_structure = "",
		$sponsor_structure = "",
		$member_register_date = "",
		$beneficiary_name ="",
		$beneficiary_ic = "",
		$member_register_adminid="",
		$member_register_memberid="",
		$member_wallet_type="",
		$member_balance_unit="",
		$member_capital="",
		$register = 0,
		$is_admin =0,
		$country_array = [],
		$package_array = [],
		$member_xy_point_status = 0,
		$check_xy_point = false,
		$check_free_acc = false,
		$country_name = '',
		$package_name = '',
		$member_detail_dob = '0000-00-00',
		$member_detail_phone_fax ='',
		$member_is_free_acc ='N';
	
	function checkLogin(){
		
		$this->db->join("member_detail","member_detail_memberid = member_id","left");
		$this->db->where('member_username', $this->member_username);
		$memberDetail  = $this->db->get('member')->row_array();
		if($memberDetail){
			if($memberDetail['member_status'] == 1){
				if($memberDetail['member_password'] == md5($this->member_password.$memberDetail['member_password_salt'])){
					// $memberDetail['member_announcement_count'] = $this->check_announcement_count($memberDetail['member_announcement_date']);
					return $memberDetail;
				
				}else{

					return false;
				}

			}else{
				
				return false;
			}	
			
		}else{
			return false;
		}
	}

	function create_random_salt()
	{
    
	    $random = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	    return $random;
	
	}

	function create_member()
	{
  
		$random = $this->create_random_salt(); 

		$query = $this->db->get_where('member',array('member_id' => $this->member_placement_id));
		$row = $query->row_array();

		$sponsor = $this->db->get_where('member',array('member_id' => $this->member_sponsor_id));
		$sponsor_row = $sponsor->row_array();

		$data = array(
				"member_username" =>$this->member_name,
				"member_email" =>$this->member_email,
				"member_password" => md5($this->member_password.$random),
				"member_password_salt" => $random, 
				"member_security_pin" =>md5($this->member_security_pin.$random),
				"member_password_plain" =>$this->member_password,
				"member_security_pin_plain" =>$this->member_security_pin,
				"member_email" =>$this->member_email,
				"member_register_date" =>  date("Y-m-d H:i:s"),
				"member_expired_date" => date("Y-m-d H:i:s",strtotime('+1 year')),
				"member_sponsor_id" =>$this->member_sponsor_id,
				"member_placement_id" =>$this->member_placement_id,
				"member_placement_position" => $this->member_placement_position,
				"member_placement_structure" =>$row['member_placement_structure']."|".$this->member_placement_id.",".$this->member_placement_position,
				"member_sponsor_structure" => $sponsor_row['member_sponsor_structure']."|".$this->member_sponsor_id,
				"member_register_memberid" => $this->member_register_memberid,
				"member_register_adminid" =>$this->member_register_adminid,
				"member_packageid" =>$this->member_packageid,
				"member_original_packageid" =>$this->member_packageid,
				"member_ranking" =>$this->member_ranking,
				"member_isfirst_login" =>$this->member_isfirst_login,
                "member_capital" => $this->member_capital,
                "member_is_free_acc" => $this->member_is_free_acc,
                // "member_default_wallet_type" => $this->member_default_wallet_type,
				"member_announcement_date" =>date("Y-m-d 00:00:00"),
				"member_manager_memberid" => 0,
				"member_ranking_2" => 0,
			);

			$this->db->insert("member",$data);
			$member_id = $this->db->insert_id();

			return $member_id;
	}

	function create_member_detail()
	{
		$data = array(
				

				"member_detail_fullname" => $this->member_detail_fullname,
				"member_detail_ic_pas" =>$this->member_detail_ic_pas,
				"member_detail_phone_mobile" =>$this->member_detail_phone_mobile,
				"member_detail_address" => $this->member_detail_address,
				"member_detail_address_2" =>$this->member_detail_address_2,
				"member_detail_register_remark" =>$this->member_detail_register_remark,
				"member_detail_beneficiary_name" =>$this->member_detail_beneficiary_name,
				"member_detail_beneficiary_fullname" =>$this->member_detail_beneficiary_fullname,
				"member_detail_beneficiary_ic" =>$this->member_detail_beneficiary_ic,
				"member_detail_beneficiary_phone" =>$this->member_detail_beneficiary_phone,
				"member_detail_country" =>$this->member_detail_country,
				"member_detail_memberid" =>$this->member_detail_memberid,

			);
			
			$this->db->insert("member_detail", $data);
			$member_id = $this->db->insert_id();
			return $member_id;

	}
	function get_id_by_username(){
		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->join("package ", "package_id = member_packageid", "left");
		$this->db->where("member_username",$this->member_username); 
		$this->db->where_not_in("member_status", 9); 
		return $this->db->get("member")->row_array();
		
	}
	function get_id_by_username_ranking()
	{
		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->join("package ", "package_id = member_ranking", "left");
		$this->db->where("member_username",$this->member_username); 
		$this->db->where_not_in("member_status", 9); 

		return $this->db->get("member")->row_array();
		
	}
	function get_id_by_memberid_ranking()
	{
		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->join("package ", "package_id = member_ranking", "left");
		$this->db->where("member_id",$this->member_id); 
		$this->db->where_not_in("member_status", 9); 

		return $this->db->get("member")->row_array();
		
	}
	function get_sponsor_fullname(){
		
		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->where('member_username',$this->member_username);
		return $this->db->get('member')->row_array();
		
	}
	function get_memberid_by_placement_structure()
	{
		$query = $this->db->get_where('member',array('member_id' => $this->member_placement_id));
		$row = $query->row_array();
		
		$this->db->where("member_placement_structure", $row['member_placement_structure']."|".$this->member_placement_id.",".$this->member_placement_position);
		$this->db->where_not_in('member_status',9);
		return $this->db->get("member")->row_array();
	}
	function get_member_placement()
	{
		$placement = $this->db->query(" SELECT * from 
									member where member_id ='".$this->member_placement_id."' 
									for update")->row_array();
		return $placement;
	}  

	function get_detail($type = 0)
	{
		$this->db->where("member_id", $this->member_id);
		$this->db->join("member_detail","member_detail_memberid = member_id","left");
		// $this->db->join("package","package_id = member_packageid","left");
		if($type == 0){
			$this->db->join("ranking","ranking_id = member_ranking","left");
		}else{
			$this->db->join("ranking","ranking_id = member_ranking_".$type." and ranking_type = ".$type,"left");
		}
		$this->db->join("member_bank","member_bank_memberid = member_id","left");
		$this->db->join("country ", "country_id = member_detail_country", "left");
		return $this->db->get("member")->row_array();
	}
	function get_detail_by_username()
	{
		$this->db->where("member_username", $this->member_username);
		$this->db->where("member_status", 1);
		$this->db->join("member_detail","member_detail_memberid = member_id","left");
		$this->db->join("ranking","ranking_id = member_ranking","left");
		$this->db->join("member_bank","member_bank_memberid = member_id","left");
		$this->db->join("country ", "country_id = member_detail_country", "left");
		return $this->db->get("member")->row_array();
	}
	function get_detail_with_sponsor_by_username()
	{	
		$this->db->select("m.*, member_detail.*, ranking.*, s.member_username sponsor_name");
		$this->db->where("m.member_username", $this->member_username);
		$this->db->where("m.member_status", 1);
		$this->db->join("member_detail","member_detail_memberid = m.member_id","left");
		$this->db->join("ranking","ranking_id = m.member_ranking","left");
		$this->db->join("member s","s.member_id = m.member_sponsor_id","left");
		return $this->db->get("member m")->row_array();
	}
	// function get_detail_with_rank(){
	// 	$this->db->where("member_id", $this->member_id);
	// 	$this->db->join("member_detail","member_detail_memberid = member_id","left");
	// 	$this->db->join("country ", "country_id = member_detail_country", "left");
	// 	$this->db->join("member_wallet", "member_wallet_memberid = member_id and member_wallet_type = 2", "left");
	// 	$this->db->join("ranking", "ranking_min_qualified < member_wallet_balance and ranking_max_qualified >= member_wallet_balance", "left");
	// 	$this->db->order_by('ranking_sponsor_bonus', 'desc');
	// 	$this->db->limit(1);
	// 	return $this->db->get("member")->row_array();
	// }

	
	function get_detail_by_id()
	{
		$this->db->where("member_id", $this->member_id);
		//$this->db->join("member_detail","member_detail_memberid = member_id","left");
		return $this->db->get("member")->row_array();
	}
	function get_placement_structure(){

		$this->db->where("member_placement_structure",$this->member_placement_structure);
		$this->db->where_not_in("member_status",9);
		return $this->db->get('member')->row_array();
	}
	function get_sponsorid_byid(){
		// echo $this->sponsor_id;
		$this->db->where("member_username",$this->sponsor_id); // $this->sponsor_id => sponsor name
		return $this->db->get("member")->row_array();
	} 
	function get_placementid_by_id(){

		$this->db->where("member_username",$this->placement_id); // $this->placement_id => placement name
		return $this->db->get("member")->row_array();
		
	}
	function get_packageid_by_memberid()
	{
		
		$this->db->where('member_id',$this->member_id);
		//$this->db->where('member_packageid',$this->member_packageid);
		$this->db->join("package ", "package_id = member_packageid", "left");
		return $this->db->get('member')->row_array();

	}
	function reset_password(){

		$this->db->where('member_id',$this->member_id);
		$member_detail = $this->db->get("member")->row_array('member_password_salt');
		$data = array(
				
				"member_password" =>md5($this->new_password.$member_detail['member_password_salt']),
				"member_password_plain" => $this->new_password,
				"member_security_pin" =>md5($this->new_security_pin.$member_detail['member_password_salt']),
				"member_security_pin_plain"=>$this->new_security_pin,
			);

		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);

	}
	function update_password(){

		$this->db->where('member_id',$this->member_id);
		$member_detail = $this->db->get("member")->row_array('member_password_salt');
		$data = array(
				
				"member_password" =>md5($this->new_password.$member_detail['member_password_salt']),
				"member_password_plain" => $this->new_password,
				"member_password_changed" => $this->member_password_changed=="Y"?"Y":"N",
			);

		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);

	}
	function update_security_pin(){

		$this->db->where('member_id',$this->member_id);
		$member_detail = $this->db->get("member")->row_array();
		$data = array(
				
				"member_security_pin" =>md5($this->new_security_pin.$member_detail['member_password_salt']),
				"member_security_pin_plain"=>$this->new_security_pin,
				"member_security_pin_changed" => $this->member_security_pin_changed,
			);

		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);

	}
	
	function update_member_detail($isfirst_login=0)
	{
	
			$data = array(
				
				"member_detail_fullname" => $this->member_detail_fullname,
				
				"member_detail_ic_pas" =>$this->member_detail_ic_pas,
				"member_detail_phone" =>$this->member_detail_phone,
				"member_detail_phone_mobile" =>$this->member_detail_phone_mobile,
				"member_detail_phone_fax" =>$this->member_detail_phone_fax,
	
				"member_detail_address" => $this->member_detail_address,
				"member_detail_address_2" =>$this->member_detail_address_2,
				"member_detail_address_3" =>$this->member_detail_address_3,
				"member_detail_postcode" =>$this->member_detail_postcode,
				"member_detail_state" =>$this->member_detail_state,
				// "member_detail_country" =>$this->member_detail_country,
	

			);
			if($isfirst_login){
				$data['member_detail_fullname'] = $this->member_detail_fullname;
				$data['member_detail_ic_pas'] = $this->member_detail_ic_pas;
			}
			if($this->member_detail_dob){
				$dob = array("member_detail_dob" =>date('Y-m-d', strtotime($this->member_detail_dob)));
				$data = array_merge($data,$dob);
			}
		
		
			
			$this->db->where('member_detail_memberid',$this->member_id);
			$this->db->update('member_detail',$data);
			
			
			return $data; 

	}
	function update_member()
	{
		
		$data = array(

				"member_username" =>$this->member_username,
				"member_email" =>$this->member_email,
				// "member_ranking" =>$this->member_ranking,
				// "member_packageid" =>$this->member_packageid,
				// "member_default_wallet_type" =>$this->member_default_wallet_type,
				"member_updated_date" =>  date("Y-m-d H:i:s"),
			
			);

		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
		
	}
	function update_member_fullname()
	{
		$data = array(

				"member_detail_fullname" => $this->member_detail_fullname,
				"member_detail_ic_pas" =>$this->member_detail_ic_pas,
				"member_detail_address" =>$this->member_detail_address,
				"member_detail_country" =>$this->member_detail_country,
				"member_detail_phone_mobile" => $this->member_detail_phone_mobile
			);

		$this->db->where('member_detail_memberid',$this->member_id);
		return $this->db->update('member_detail',$data);
	}
	function update_member_bank_country(){
		$data = array(
			"member_bank_country" => $this->member_detail_country,
		);
		$this->db->where('member_bank_memberid',$this->member_id);
		return $this->db->update('member_bank',$data);

	}
	function update_ranking()
	{
		
		$data = array(

				"member_ranking" =>$this->member_ranking,
				// "member_packageid" =>$this->member_ranking,
				"member_updated_date" =>  date("Y-m-d H:i:s"),
			
			);
		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	// function update_ranking($type = 0)
	// {
		
	// 	$data = array(

	// 			"member_ranking".($type>0?"_".$type:"") =>$this->member_ranking,
	// 			"member_updated_date" =>  date("Y-m-d H:i:s"),
			
	// 		);
	// 	$this->db->where('member_id',$this->member_id);
	// 	return $this->db->update('member',$data);
	// }
	function update_allow_downgrade_ranking_by_memberid()
	{
		$data = array(

				"member_allow_downgrade_ranking" =>$this->member_allow_downgrade_ranking,
			
			);

		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	function update_package()
	{
		$data = array(

				"member_packageid" =>$this->package_id,
			
			);

		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	function update_xy_point_status()
	{
		$data = array(

			"member_xy_point_status" =>$this->member_xy_point_status,
			
			);

		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	function update_xy2_point_status()
	{
		$data = array(

			"member_xy2_point_status" =>$this->member_xy2_point_status,
			
			);

		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	function create_ranking_log()
	{

		$data = array(
				"member_upgrade_ranking_memberid" =>$this->member_id,
				"member_upgrade_ranking_type" => $this->member_upgrade_ranking_type,
				"member_upgrade_ranking_old_rankingid" =>$this->old_ranking_id,
				"member_upgrade_ranking_rankingid" =>$this->new_ranking_id,
				"member_upgrade_ranking_updated_date" =>  date("Y-m-d H:i:s"),
			
			);

		return $this->db->insert('member_upgrade_ranking',$data);
	}
	function create_package_log()
	{

		$data = array(

				"member_upgrade_package_memberid" =>$this->member_id,
				"member_upgrade_package_old_package" =>$this->package_id,
				"member_upgrade_package_new_package" =>$this->new_package_id,
				"member_upgrade_package_created_by" =>$this->member_id,
				"member_upgrade_package_created_date" =>date("Y-m-d H:i:s"),
			
			);

		return $this->db->insert('member_upgrade_package',$data);
	}
	//admin panel member pagination
	function all($limit = 0,$admin_role=0){
		$this->db->select('m.*, member_detail.*, ranking.*, country.*, s.member_username sponsor_name');
		$this->db->join("member_detail", "m.member_id = member_detail_memberid", "left");
		$this->db->join("ranking ", "ranking_id = m.member_ranking", "left");
		$this->db->join("country ", "country_id = member_detail_country", "left");
		$this->db->join("member s", "s.member_id = m.member_sponsor_id", "left");
		//search option
		if($admin_role==2)
		{
			$this->db->join('member_privilege','member_privilege_memberid= m.member_id','left');
			$this->db->where('member_privilege_key','SPECIAL_MEMBER_GROUP');
			$this->db->where('member_privilege_status',1);
		}
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('m.member_register_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('m.member_register_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('m.member_register_date <=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('m.member_username', $this->search_title); 
		}
		if($this->search_status){
			$this->db->where('m.member_status', $this->search_status); 
		}
		$this->db->order_by('m.member_register_date', 'DESC');
		$this->db->limit($limit);
		$this->db->offset($this->offset);
		$query = $this->db->get('member m');
		return $query->result_array() ;
	}

	function ajax_all($limit = 0,$admin_role)
	{
		$this->db->start_cache();
		$this->db->select('m.*, member_detail.*, ranking.*, country.*, s.member_username sponsor_name');
		$this->db->join("member_detail", "m.member_id = member_detail_memberid", "left");
		$this->db->join("ranking ", "ranking_id = m.member_ranking", "left");
		$this->db->join("country ", "country_id = member_detail_country", "left");
		$this->db->join("member s", "s.member_id = m.member_sponsor_id", "left");

		$this->db->from('member m');
		//search option
		if($admin_role==2)
		{
			$this->db->join('member_privilege','member_privilege_memberid= m.member_id','left');
			$this->db->where('member_privilege_key','SPECIAL_MEMBER_GROUP');
			$this->db->where('member_privilege_status',1);
		}
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('m.member_register_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('m.member_register_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('m.member_register_date <=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('m.member_username', $this->search_title); 
		}

		if($this->member_detail_fullname)
		{
			$this->db->like('member_detail_fullname', $this->member_detail_fullname); 
		}
		if($this->member_detail_address)
		{
			$this->db->like('member_detail_address', $this->member_detail_address); 
		}
		if($this->member_register_date)
		{
			$this->db->like('m.member_register_date', $this->member_register_date); 
		}		
		if($this->member_detail_ic_pas)
		{
			$this->db->like('member_detail_ic_pas', $this->member_detail_ic_pas); 
		}
		if($this->member_email)
		{
			$this->db->like('m.member_email', $this->member_email); 
		}
		if(isset($this->sponsor_name) &&  $this->sponsor_name)
		{
			$this->db->like('s.member_username', $this->sponsor_name); 
		}
		if($this->member_capital)
		{
			$this->db->where('m.member_capital >=', $this->member_capital); 
		}
		if( $this->country_array )
		{
			foreach( $this->country_array as $country )
			{
				$country_ids[] = $country['country_id'];
			}
			$this->db->where_in('member_detail_country', $country_ids );
		}
		else
		{
			if( $this->country_name != '' )
			{
				$this->db->where('member_detail_country', '0' );
			}
		}

		if($this->package_array)
		{
			foreach( $this->package_array as $package )
			{
				$package_ids[] = $package['package_id'];
			}
			$this->db->where_in('m.member_ranking', $package_ids );
		}
		else
		{
			if( $this->package_name != '' )
			{
				$this->db->where('m.member_ranking', '0' );
			}
		}
		if( $this->check_free_acc )
		{
			$this->db->where('m.member_is_empty_acc', $this->member_is_empty_acc);
		}
		if( $this->check_xy_point )
		{
			$this->db->where('m.member_xy_point_status', $this->member_xy_point_status);
		}
		if( $this->check_xy2_point )
		{
			$this->db->where('m.member_xy2_point_status', $this->member_xy2_point_status);
		}
		if($this->search_status){
			$this->db->where('m.member_status', $this->search_status); 
		}
		$this->db->stop_cache();
		
		$data['total_rows'] = $this->db->count_all_results();

		$this->db->order_by('m.member_register_date', 'DESC');
		$this->db->limit($limit);
		$this->db->offset($this->offset);

		$query = $this->db->get();
		$data['members'] = $query->result_array() ;
		return $data;
	}


	function count($admin_role){
		$this->db->join("member_detail", "member_id = member_detail_memberid", "left");
		$this->db->join("package ", "package_id = member_ranking", "left");
		$this->db->join("country ", "country_id = member_detail_country", "left");
		//search option
		if($admin_role==2)
		{
			$this->db->join('member_privilege','member_privilege_memberid= member_id','left');
			$this->db->where('member_privilege_key','SPECIAL_MEMBER_GROUP');
			$this->db->where('member_privilege_status',1);
		}
		if(($this->search_start_date)&&($this->search_end_date)){
			$this->db->where('member_register_date
				BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
				AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
		}
		if(($this->search_start_date)&&(!$this->search_end_date)){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('member_register_date>=', $search_start_date);
		}
		if((!$this->search_start_date)&&($this->search_end_date)){
			$search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
			$this->db->where('member_register_date <=', $search_end_date);
		}
		if($this->search_title){
			$this->db->like('member_username', $this->search_title); 
		}
		if($this->search_status){
			$this->db->where('member_status', $this->search_status); 
		}
		return $this->db->count_all_results('member');		
	}
	function admim_member_get_ajax_result(){
		
		$this->db->select('*');
		$this->db->from('member');
		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->where('member_id',$this->member_id_ajax);
		return $this->db->get();
       
	}
	function get_member_placement_by_count()
	{
		$data = array();
		$this->db->select('count(*) as total');
		$this->db->like("member_placement_structure",$this->placement_account_left,'after');
		$this->db->where_not_in("member_status",9);
		$total_left = $this->db->get('member')->row_array();

		$this->db->select('count(*) as total');
		$this->db->like("member_placement_structure",$this->placement_account_right,'after');
		$this->db->where_not_in("member_status",9);
		$total_right = $this->db->get('member')->row_array();

		$data['total_left']  = $total_left['total'];
		$data['total_right']  = $total_right['total'];
		return $data;
	}
	function get_total_placement_by_count()
	{
		$data = array();
		$this->db->select('count(*) as total');
		$this->db->where('member_placement_id',$this->member_id);
		$this->db->where_not_in('member_status', 9);
		$placement = $this->db->get("member")->row_array();
		
		$data['total_placement'] = $placement['total'];

		$this->db->select('count(*) as total');
		$this->db->where('member_sponsor_id',$this->member_id);
		$this->db->where_not_in('member_status', 9);
		$sponsor = $this->db->get("member")->row_array();
		
		$data['total_sponsor'] = $sponsor['total'];

		return $data;
	}

	function get_placement(){ //member/placement
		$this->db->select('member_id, member_username,  member_placement_position, member_capital, member_placement_id,  member_detail.member_detail_profile_image,  member_status');
		$this->db->join("member_detail", "member_detail.member_detail_memberid = member.member_id", "left"); // added by Steve 11/7/2017
		$this->db->where('member_placement_id',$this->placement_member_id);
		$this->db->where_not_in('member_status',9);
		$this->db->order_by('member_placement_position', 'ASC');
		return $this->db->get('member')->result_array();

	}

	function wallet_fullname_ajax_process(){

		$this->db->join('member_detail', 'member.member_id = member_detail.member_detail_memberid');
		$this->db->where('member_name',$this->wallet_username);
		return $this->db->get('member')->row_array();
		
	}
	function update_member_status()
	{
		$data = array(

			"member_status" => $this->member_status
		);

			$this->db->where('member_id',$this->member_id);
			$this->db->update('member',$data);
			return $data;
	}
	function get_sponsor_structure_ajax(){
		$data = array();
		$this->db->where("member_sponsor_id",$this->sponsor_id);
		$this->db->select("count(*) as total");
		$this->db->where_not_in("member_status",9);
		$total = $this->db->get("member")->row_array();
		$data['total'] = $total['total'];

		$this->db->where_not_in("member_status",9);
		$this->db->where("member_sponsor_id",$this->sponsor_id);
		$this->db->select('member_id,member_username,member_sponsor_structure,member_detail.member_detail_fullname,member_ranking,member_packageid,member_detail_fullname,member_register_date,member_capital');
		// $this->db->join("package", "member.member_ranking = package.package_id", "left");
		$this->db->join("member_detail", "member_detail.member_detail_memberid = member.member_id", "left");
		$sponsor_structure = $this->db->get("member")->result_array();
		$data['member_sponsor_structure'] = $sponsor_structure;

		return $data;
	}
	function get_member_sponsor_by_count(){
		$data = array();
		$this->db->select('count(*) as total');
		$this->db->like("member_sponsor_structure",$this->sponsor_structure);
		$this->db->where_not_in("member_status",9);
		return $this->db->get('member')->row_array();
	}
	function get_member_sponsor_by_capital(){
		$data = array();
		$this->db->select('sum(member_capital) as total');
		$this->db->like("member_sponsor_structure",$this->sponsor_structure);
		$this->db->where_not_in("member_status",9);
		return $this->db->get('member')->row_array();
	}
	function sponsor_determine_downline(){
		$this->db->where("member_sponsor_id",$this->sponsor_downline_id);
		$this->db->where_not_in("member_status",9);
		return $this->db->get('member')->row_array();
	}
	function get_sponsor_id()
	{
		$this->db->select('member_id, member_sponsor_id, member_sponsor_structure, member_ranking');
		$this->db->where("member_sponsor_id",$this->sponsor_id);
		$this->db->where_not_in("member_status",9);
		return $this->db->get('member')->result_array();
	}
	function get_member_id_by_count_package_id()
	{
		$this->db->select('count(*) as total');
		$this->db->like('package_support_bonus ',$this->package_support_bonus);
		$this->db->where_not_in("member_status",9);
		$this->db->where("member_sponsor_id",$this->member_id);
		$this->db->join("package ", "package_id = member_ranking", "left");
		return $this->db->get('member')->row_array();
	}
	function get_count_by_bonus_pairing_id()
	{
		$this->db->select('count(b.member_id) as total');
		$this->db->where('a.member_sponsor_id',$this->member_id);
		$this->db->where('b.member_ranking = c.package_id');
		$this->db->where_not_in("b.member_status",9);
		//$this->db->where("member_sponsor_id",$this->member_id);
		$this->db->join("member as b ", " b.member_sponsor_id = a.member_id", "left");
		$this->db->join("package as c ", " c.package_name IN (".$this->package_name.")", "left");
		return $this->db->get('member as a')->row_array();
	}
	function get_member_sponsor_total()
	{
		$this->db->select("COUNT(member_id) as total");
		$this->db->where("member_register_date >=", $this->start_date);
		$this->db->where("member_register_date <=", $this->end_date);
		$this->db->where('member_status',1);
		return $this->db->get("member")->row_array();
	
	}
	
	function get_member_wallet_detail()
	{
		$this->db->where("member_wallet_memberid", $this->member_register_memberid);
		$this->db->where("member_wallet_type", $this->member_wallet_type);
		return $this->db->get("member_wallet")->row_array();
	
	}
	
	function update_member_share(){
		
		
		$query = $this->db->query(" UPDATE member_share 
							set member_share_balance = member_share_balance + ".$this->member_balance_unit." 
							WHERE member_share_memberid ='".$this->member_register_memberid."'");
		
		/*
		$data = array(

			"member_share_balance" => $this->member_balance_unit
		);
		
		$this->db->where("member_share_memberid", $this->member_register_memberid);
		$query = $this->db->update('member_share',$data);
		
		*/	
		/*return $query;
		
		
	}

	function get_total_register_package_by_count()
	{
		$this->db->join('member_detail','member_detail_memberid = member_id','left');
		$this->db->select('COUNT(member_packageid) as total');
		$this->db->where_in('member_original_packageid', $this->member_packageid);

		if($this->country_select!=''){
			$this->db->where('member_detail_country',$this->country_select);
		}
		if($this->search_start_date){
			$search_start_date=date('Y-m-d 00:00:00', strtotime($this->search_start_date));
			$this->db->where('member_register_date >=', $search_start_date);
		}

		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_register_date <=', $search_end_date);
		}

		return $this->db->get('member')->row_array();
	}

	function get_total_upgrade_package_by_count()
	{
		$this->db->join('member_detail','member_detail_memberid = member_upgrade_package_memberid','left');
		$this->db->select('COUNT(member_upgrade_package_new_package) as total');
		$this->db->where_in('member_upgrade_package_new_package', $this->member_upgrade_package_new_package);

		if($this->country_select!=''){
			$this->db->where('member_detail_country',$this->country_select);
		}
		if($this->search_start_date){
			$search_start_date=date('Y-m-d 00:00:00', strtotime($this->search_start_date));
			$this->db->where('member_upgrade_package_created_date >=', $search_start_date);
		}

		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_upgrade_package_created_date <=', $search_end_date);
		}

		return $this->db->get('member_upgrade_package')->row_array();
	}
	function get_total_package_by_count()
	{
		$data = array();

		$this->db->join('member_detail','member_detail_memberid = member_id','left');
		$this->db->select('COUNT(member_packageid) as total');
		$this->db->where_in('member_original_packageid', $this->member_packageid);

		if($this->country_select!=''){
			$this->db->where('member_detail_country',$this->country_select);
		}
		if($this->search_start_date){
			$search_start_date=date('Y-m-d 00:00:00', strtotime($this->search_start_date));
			$this->db->where('member_register_date >=', $search_start_date);
		}

		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_register_date <=', $search_end_date);
		}
		$data['register'] = $this->db->get('member')->row_array();

		$this->db->join('member_detail','member_detail_memberid = member_upgrade_package_memberid','left');
		$this->db->select('COUNT(member_upgrade_package_new_package) as total');
		$this->db->where_in('member_upgrade_package_new_package', $this->member_upgrade_package_new_package);

		if($this->country_select!=''){
			$this->db->where('member_detail_country',$this->country_select);
		}
		if($this->search_start_date){
			$search_start_date=date('Y-m-d 00:00:00', strtotime($this->search_start_date));
			$this->db->where('member_upgrade_package_created_date >=', $search_start_date);
		}

		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_upgrade_package_created_date <=', $search_end_date);
		}

		$data['upgrade'] = $this->db->get('member_upgrade_package')->row_array();
		return $data;
	}
	function get_username_by_id(){

		$this->db->where("member_username",$this->member_username);
		return $this->db->get("member")->row_array();
		
	}
	function get_detail_by_like_placement_structure()
	{
		$result = $this->db->query("SELECT * from member where member_status = 1 and member_id = ".$this->member_id."
			and (member_placement_structure = ".$this->db->escape($this->direct_placement_structure)."
				OR member_placement_structure LIKE '%".$this->db->escape_like_str($this->member_placement_structure)."%' ESCAPE '!')")->row_array();
		return $result;
	}

	function get_free_account_member_detail() {

		$this->db->join("member_detail", "member_id = member_detail_memberid", "left");
		$this->db->join("package ", "package_id = member_packageid", "left");
		// $this->db->join("member_wallet ", "member_wallet_memberid = member_id", "left");

		if($this->search_date) {
			$this->db->where('member_register_date <= "'. $this->search_date.'" ');
		}
		$this->db->where_in('member_packageid',array('5','6','7','19','22'));
		$this->db->where('member_status','1');

		$query = $this->db->get('member');
		return $query->result_array() ;
	}
	function get_list_by_packageid()
	{
		$this->db->select('member_id,member_free_acc_completed_date,member_packageid,member_ranking');
		$this->db->where_in('member_packageid',$this->member_packageid);
		$this->db->where('member_status',$this->member_status);
		$this->db->where('member_free_acc_completed_date',$this->member_free_acc_completed_date);
		return $this->db->get('member')->result_array();
	}
	function update_free_acc_completed_date()
	{
		$data = array(
			"member_free_acc_completed_date"=>$this->member_free_acc_completed_date
			);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
	}
	function update_free_acc_status()
	{
		$data = array(
			"member_is_free_acc"=>$this->member_is_free_acc
			);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
	}
	function update_announcement_date() {
		$update_date = date('Y-m-d H:i:s');
		$data = array(
			"member_announcement_date"=>$update_date,
		);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
		return $update_date;
	}

	function check_announcement_count($read_date) {
		$this->db->where('announcement_created_date >=',$read_date);
		return $this->db->get('announcement')->num_rows();
	}

	function get_list_free_acc()
	{
		$this->db->where('member_is_free_acc',$this->member_is_free_acc);
		$this->db->where('member_status',1);
		$this->db->where('member_free_acc_completed_date',$this->member_free_acc_completed_date);
		return $this->db->get('member')->result_array();

	}
	function get_member_log_by_action()
	{
		$this->db->join('member','member_id= member_log_memberid','left');
		$this->db->where('member_log_suspend_reason',$this->member_log_suspend_reason);
		$this->db->where('member_log_action',$this->member_log_action);
		$this->db->where('member_status',10);
		return $this->db->get('member_log')->result_array();
	}
	function create_member_log()
	{
		$data = array(
			"member_log_memberid"=>$this->member_log_memberid,
			"member_log_member_username"=>$this->member_log_member_username,
			"member_log_member_password"=>$this->member_log_member_password,
			"member_log_member_password_salt"=>$this->member_log_member_password_salt,
			"member_log_member_email"=>$this->member_log_member_email,
			"member_log_suspend_reason"=>$this->member_log_suspend_reason,
			"member_log_action"=>$this->member_log_action,
			"member_log_created_date"=>date('Y-m-d H:i:s'),

			);
		$this->db->insert("member_log",$data);
		$member_log = $this->db->insert_id();
		return $member_log;
	}
	function update_member_isfirst_login()
	{
		$data = array(
			"member_isfirst_login"=>$this->member_isfirst_login
		);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
	}
	function update_member_email()
	{
		$data = array(
			"member_email"=>$this->member_email
		);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
	}
	function update_profile_img()
	{
		$data = array(
			"member_detail_profile_image"=>$this->member_detail_profile_image
			);
		$this->db->where("member_detail_memberid",$this->member_detail_memberid);
		$this->db->update('member_detail',$data);
	}
	function get_list_by_register_date()
	{
		$this->db->select('member_id,member_username,member_packageid,member_ranking');
		$this->db->where('member_status',$this->member_status);
		$this->db->where('member_register_date>=',$this->start_date);
		$this->db->where('member_register_date<=',$this->end_date);
		$this->db->where_in('member_packageid',$this->member_packageid);
		return $this->db->get('member')->result_array();
	}
	function update_old_member_capital()
	{
		$this->db->query("update member 
						join (
							SELECT
								member_wallet_trx_memberid, sum(package_price) total_amount
							FROM
									member_wallet_trx 
							JOIN package on  ROUND(package_share_point,0) = ROUND(member_wallet_trx_amount,0)
							WHERE
									member_wallet_trx_trxtype = 9
									and package_price > 0
									and package_id  <> 20
							Group by member_wallet_trx_memberid

						) new_data 
						on member_id = member_wallet_trx_memberid
						set member_capital = total_amount");

		$this->db->query("update member 
						join (
							SELECT
								member_wallet_trx_memberid, sum(member_wallet_trx_amount * -1) total_amount
							FROM
									member_wallet_trx 
							WHERE
									member_wallet_trx_trxtype = 7
								  and member_wallet_trx_type in (1,4)
							Group by member_wallet_trx_memberid

						) new_data 
						on member_id = member_wallet_trx_memberid
						set member_capital = member_capital + total_amount;");
	}
	function update_member_capital()
	{
		return $this->db->query("UPDATE member set member_capital=".$this->member_capital." WHERE member_id = ".$this->member_id."");
	}
	function update_original_packageid()
	{
		$this->db->query("update member set member_original_packageid = member_packageid");
		$this->db->query("update member join
					    (
					    	SELECT 
					    		member_upgrade_package_old_package,member_upgrade_package_memberid 
					    	FROM 
					    		member_upgrade_package 

					    	GROUP BY 
					    		member_upgrade_package_memberid 
					    	ORDER BY member_upgrade_package_created_date ASC
					    )new_data
						on member_id = member_upgrade_package_memberid
						set member_original_packageid = member_upgrade_package_old_package;");
	}
	function get_member_sales_report($member_id, $date_start,$date_end){
		$sql = "select m.*,d.member_detail_fullname ,p.member_username as placement_username,";
		$sql = $sql."(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_sponsor_id = m.member_id and ps.member_status = 1 and member_sales_report_created_date>='".$date_start."' and member_sales_report_created_date <='".$date_end."' ) as personal_sales, ";
		$sql = $sql."(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_placement_structure like concat(m.member_placement_structure,'|',m.member_id,',%') and ps.member_status = 1 and member_sales_report_created_date>='".$date_start."' and member_sales_report_created_date <='".$date_end."' ) as group_sales ";
		$sql = $sql."from member m 
				left join member p on m.member_placement_id = p.member_id
				left join member_detail d on m.member_id = d.member_detail_memberid
				where m.member_status = 1 and m.member_id ='".$member_id."'";
		return $this->db->query($sql)->result_array();
	}
	function get_member_sales_report_by_placement_list($placement_list, $date_start,$date_end){
		$sql = "select m.*,d.member_detail_fullname ,p.member_username as placement_username,";
		$sql = $sql."(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_sponsor_id = m.member_id and ps.member_status = 1 and member_sales_report_created_date>='".$date_start."' and member_sales_report_created_date <='".$date_end."' ) as personal_sales, ";
		$sql = $sql."(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_placement_structure like concat(m.member_placement_structure,'|',m.member_id,',%') and ps.member_status = 1 and member_sales_report_created_date>='".$date_start."' and member_sales_report_created_date <='".$date_end."' ) as group_sales ";
		$sql = $sql."from member m 
				left join member p on m.member_placement_id = p.member_id
				left join member_detail d on m.member_id = d.member_detail_memberid
				where m.member_status = 1 and m.member_placement_id in(";
		$list = "";
		foreach($placement_list as $placementid){
			if($list!=""){
				$list = $list.',';
			}
			$list= $list."'".$placementid."'";	
		}
		$sql = $sql.$list.') order by m.member_placement_id, m.member_placement_position';
		return $this->db->query($sql)->result_array();

		// $this->db->select("m.*,d.member_detail_fullname ,p.member_username as placement_username, 
		// 					(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_sponsor_id = m.member_id and ps.member_status = 1) as personal_sales, 
		// 					(SELECT ifnull(sum(member_sales_report_amount),0) FROM member ps join member_sales_report msr on ps.member_id = msr.member_sales_report_memberid where ps.member_placement_structure like concat(m.member_placement_structure,'|',m.member_id,',%') and ps.member_status = 1) as group_sales");
		// $this->db->join('member p','m.member_placement_id = p.member_id','left');
		// $this->db->join('member_detail d','m.member_id = d.member_detail_memberid','left');
		// $this->db->where('m.member_status',1);
		// $this->db->where_in('m.member_placement_id',$placement_list);
		// $this->db->order_by('m.member_placement_id','ASC');
		// $this->db->order_by('m.member_placement_position','ASC');
		// return $this->db->get('member m')->result_array();
	}
	function get_member_direct_sponsor($member_id){
		$this->db->where('member.member_sponsor_id',$member_id);
		return $this->db->get('member')->result_array();
	}
	
	function get_member_bv_in_row($member_id){
		$bv = array(
			'left'=> 0,
			'left_balance' => 0,
			'left_pairing' => 0,
			'right'=> 0,
			'right_balance' => 0,
			'right_pairing'=> 0,
		);
		$this->db->where('member_bv_memberid',$member_id);
		$this->db->order_by('member_bv_position');
		$bv_results = $this->db->get('member_bv')->result_array();
		foreach($bv_results as $row){
			if($row['member_bv_position']=="L"){
				$bv['left'] = $row['member_bv_accumulate'];
				$bv['left_balance'] = $row['member_bv_balance'];
				$bv['left_pairing'] = $row['member_bv_history_pairing'];
			}
			else{
				$bv['right'] = $row['member_bv_accumulate'];
				$bv['right_balance'] = $row['member_bv_balance'];
				$bv['right_pairing'] = $row['member_bv_history_pairing'];
			}
		}
		return $bv;
	}
	function update_username()
	{
		$data = array(
			'member_username'=>$this->member_username,
			);
		$this->db->where('member_id',$this->member_id);
		return $this->db->update('member',$data);
	}
	function get_total_original_capital_by_date()
	{
		$this->db->join('package','package_id = member_original_packageid','left');
		$this->db->select('SUM(package_price) as original_capital');
		$this->db->where('member_register_date>=',$this->start_date);
		$this->db->where('member_register_date<=',$this->end_date);
		$this->db->where('member_original_packageid!=',7);
		$this->db->where('member_status',1);
		$this->db->group_by('member_id');
		return $this->db->get('member')->row_array();
	}
	function get_member_for_update(){
		$member = $this->db->query(" SELECT * from 
									member where member_id ='".$this->member_id."' 
									for update")->row_array();
		return $member;
	}
	function insert_member_sponsor_level(){
		$data = array(
					"member_sponsor_level_memberid" =>$this->member_sponsor_level_memberid,
					"member_sponsor_level_sponsor_level" =>$this->member_sponsor_level_sponsor_level,
					"member_sponsor_level_sponsor_id" => $this->member_sponsor_level_sponsor_id,
				);
		$this->db->insert("member_sponsor_level",$data);
		$member_id = $this->db->insert_id();
		return $member_id;
	}
	function check_remit_pending(){
		$this->db->where('member_remit_log_memberid', $this->member_remit_log_memberid);
		$this->db->where('member_remit_log_status', 0);
		return $this->db->get('member_remit_log')->row_array();
	}
	function create_rermit_log(){
		$data = array(
			'member_remit_log_memberid' => $this->member_remit_log_memberid,
			'member_remit_log_rate' => $this->member_remit_log_rate,
			'member_remit_log_amt' => $this->member_remit_log_amt,
			'member_remit_log_created_date' => $this->member_remit_log_created_date,
			'member_remit_log_bankin_date' => date('Y-m-d H:i:s', strtotime($this->member_remit_log_bankin_date)),
			'member_remit_log_attachment' => $this->member_remit_log_attachment,
			'member_remit_log_status' => $this->member_remit_log_status,
			'member_remit_log_type' => $this->member_remit_log_type,
			'member_remit_log_wallet_type' => $this->member_remit_log_wallet_type,
			'member_remit_log_countryid' => $this->member_remit_log_countryid,
			'member_remit_log_amt_payment' => $this->member_remit_log_amt_payment,
		);
		$this->db->insert('member_remit_log', $data);
		$member_id = $this->db->insert_id();
		return $member_id;
	}
	function remit_all($limit = 0){
		$this->db->join("member","member_id = member_remit_log_memberid","left");
		$this->db->join("country","country_id = member_remit_log_countryid","left");
		if($this->search_start_date){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('member_remit_log_created_date>=', $search_start_date);
		}
		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_remit_log_created_date<=', $search_end_date);
		}
		if($this->search_username!=''){
			$this->db->where('member_username',$this->search_username);
		}
		if($this->search_title!=''){
			$this->db->where('member_remit_log_status',$this->search_title);
		}
		if($this->member_remit_log_memberid){
			$this->db->where('member_remit_log_memberid',$this->member_remit_log_memberid);
		}
		$this->db->order_by('member_remit_log_created_date','DESC');
		$this->db->limit($limit);
		$this->db->offset($this->offset);
		return $this->db->get('member_remit_log')->result_array();
	}
	
function remit_count(){
		$this->db->join("member","member_id = member_remit_log_memberid","left");
		if($this->search_start_date){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('member_remit_log_created_date>=', $search_start_date);
		}
		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_remit_log_created_date<=', $search_end_date);
		}
		if($this->search_username!=''){
			$this->db->where('member_username',$this->search_username);
		}
		if($this->search_title!=''){
			$this->db->where('member_remit_log_status',$this->search_title);
		}
		if($this->member_remit_log_memberid){
			$this->db->where('member_remit_log_memberid',$this->member_remit_log_memberid);
		}
		return $this->db->count_all_results('member_remit_log');	
	}
	function get_sum_total_remit(){
		$this->db->join("member","member_id = member_remit_log_memberid","left");
		$this->db->select('SUM(member_remit_log_amt) as total');
		if($this->search_start_date){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('member_remit_log_created_date>=', $search_start_date);
		}
		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_remit_log_created_date<=', $search_end_date);
		}
		if($this->search_username!=''){
			$this->db->where('member_username',$this->search_username);
		}
		if($this->search_title!=''){
			$this->db->where('member_remit_log_status',$this->search_title);
		}
		if($this->member_remit_log_memberid){
			$this->db->where('member_remit_log_memberid',$this->member_remit_log_memberid);
		}
		return $this->db->get('member_remit_log')->row_array();
	}
	function get_sum_total_remit_by_rate(){
		$this->db->join("member","member_id = member_remit_log_memberid","left");
		$this->db->select('SUM(member_remit_log_amt * member_remit_log_rate) as total');
		if($this->search_start_date){
			$search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
			$this->db->where('member_remit_log_created_date>=', $search_start_date);
		}
		if($this->search_end_date){
			$search_end_date=date('Y-m-d 23:59:59', strtotime($this->search_end_date));
			$this->db->where('member_remit_log_created_date<=', $search_end_date);
		}
		if($this->search_username!=''){
			$this->db->where('member_username',$this->search_username);
		}
		if($this->search_title!=''){
			$this->db->where('member_remit_log_status',$this->search_title);
		}
		if($this->member_remit_log_memberid){
			$this->db->where('member_remit_log_memberid',$this->member_remit_log_memberid);
		}
		return $this->db->get('member_remit_log')->row_array();
	}
	function get_remittance_detail()
	{
		$this->db->where('member_remit_log_id',$this->member_remit_log_id);
		return $this->db->get('member_remit_log')->row_array();
	}
	function update_status_rermit_log(){
		$data = array(
				'member_remit_log_status' =>$this->member_remit_log_status,
				'member_remit_log_approved_by' =>$this->member_remit_log_approved_by,
				'member_remit_log_approved_date ' =>$this->member_remit_log_approved_date,
				'member_remit_log_remark ' =>$this->member_remit_log_remark,
			);
		$this->db->where('member_remit_log_id',$this->member_remit_log_id);
		$this->db->where('member_remit_log_status', 0);
		return $this->db->update('member_remit_log',$data);
	}
	function count_total_downline(){
		$this->db->where('member_sponsor_id', $this->member_sponsor_id);
		$this->db->where('member_capital >', 0);
		$this->db->where('member_status',1);
		return $this->db->count_all_results('member');		
	}
	function create_member_login(){
		$data = array(
			"member_login_memberid" => $this->member_login_memberid,
			"member_login_session" => $this->member_login_session,
			"member_login_created_date" => date('Y-m-d H:i:s'),
			"member_login_status" => 1,
			"member_login_last_access" =>  date('Y-m-d H:i:s'),
			"member_login_updated_date" => date('Y-m-d H:i:s'),
			"member_login_ip_address" =>$this->member_login_ip_address,
		);
		$this->db->insert('member_login',$data);
		$insertedId = $this->db->insert_id();
		return $insertedId;
	}
	
	function update_session_last_access(){
		$data = array(
			"member_login_last_access" =>  date('Y-m-d H:i:s'),
			"member_login_status" =>  2,
			"member_login_updated_date" => date('Y-m-d H:i:s'),
		);
		$this->db->where('member_login_id', $this->member_login_id);
		return $this->db->update('member_login',$data);
	}
	function login_by_session(){
		$this->db->join("member","member_id = member_login_memberid");
		$this->db->join("member_detail","member_detail_memberid = member_id","left");
		$this->db->where('member_login_session',$this->member_login_session);
		$this->db->where('member_login_status', 1);
		$memberDetail  = $this->db->get('member_login')->row_array();
		if($memberDetail){
			if($memberDetail['member_status'] != 9){
				return $memberDetail;
			}else{
				return false;
			}	
		}else{
			return false;
		}
	}
	function get_member_manager_for_update(){
		$sql = "select * from member where concat(member_sponsor_structure,'|') like '".$this->member_sponsor_structure."%' and member_manager_memberid = '".$this->member_manager_memberid."' for update";
		return $this->db->query($sql)->result_array();
	}
	function update_member_manager(){
		$sql = "update member
				set member_manager_memberid = '".$this->new_manager_id."'
				where member_sponsor_structure like '".$this->member_sponsor_structure."%' and member_manager_memberid = '".$this->member_manager_memberid."'";
		return $this->db->query($sql);
	}
	function get_member_detail_by_memberid()
	{
		$this->db->where('member_detail_memberid',$this->member_detail_memberid);
		return $this->db->get('member_detail')->row_array();
	}
	function get_member_detail_by_memberid_for_update()
	{
		$sql = "select * from member_detail where member_detail_memberid = '".$this->member_detail_memberid."' for update";
		return $this->db->query($sql)->row_array();
	}
	function get_email_by_count()
	{
		$this->db->select("COUNT(*) as total");
		$this->db->where('member_email',$this->member_email);
		return $this->db->get('member')->row_array();
	}
	function update_password_batch($member_id, $new_password){
		$sql = "select * from member where member_id <> 1 and member_password_plain <> '".$new_password."' "
				.($member_id == 0?" ":" and member_id = '".$member_id."' ").
				" limit 1000 for update";
		$members = $this->db->query($sql)->result_array();
		foreach($members as $member){
			$this->db->where('member_id',$member['member_id']);
			$data = array(
				"member_password" =>md5($new_password.$member['member_password_salt']),
				"member_password_plain" => $new_password,
			);
			$this->db->update('member',$data);
		}
	

	}
	function update_security_batch($member_id, $new_password){
		$sql = "select * from member where member_id <> 1 and member_security_pin_plain <> '".$new_password."' "
				.($member_id == 0?" ":" and member_id = '".$member_id."' ").
				" limit 1000 for update";
		$members = $this->db->query($sql)->result_array();
		foreach($members as $member){
			$this->db->where('member_id',$member['member_id']);
			$data = array(
				"member_security_pin" =>md5($new_password.$member['member_password_salt']),
				"member_security_pin_plain" => $new_password,
			);
			$this->db->update('member',$data);
		}
	}
	function update_member_privilege(){
		$data = array(
			"member_privilege_status" => 9,
			"member_privilege_updated_by" => $this->member_privilege_created_by,
			"member_privilege_updated_date" => date('Y-m-d 00:00:00'),
		);
		$this->db->where('member_privilege_key', $this->member_privilege_key);
		$this->db->where('member_privilege_memberid', $this->member_privilege_memberid);
		$this->db->where('member_privilege_status', 1);

		$this->db->update('member_privilege',$data);

		$data = array(
			"member_privilege_memberid" => $this->member_privilege_memberid,
			"member_privilege_key" => $this->member_privilege_key,
			"member_privilege_value" => $this->member_privilege_value,
			"member_privilege_status" => 1,
			"member_privilege_created_by" => $this->member_privilege_created_by,
			"member_privilege_created_date" => date('Y-m-d H:i:s'),
		);
		$this->db->insert("member_privilege",$data);
		$id = $this->db->insert_id();
		return $id;
	}
	function get_member_privilege(){
		$this->db->where('member_privilege_key', $this->member_privilege_key);
		$this->db->where('member_privilege_memberid', $this->member_privilege_memberid);
		$this->db->where('member_privilege_status', 1);

		return $this->db->get('member_privilege')->row_array();
	}
	function get_all_member_privilege(){
		$this->db->where('member_privilege_memberid', $this->member_privilege_memberid);
		$this->db->where('member_privilege_status', 1);

		return $this->db->get('member_privilege')->result_array();
	}
	function create_summary(){
		$data = array(
            "member_summary_memberid"=>$this->member_summary_memberid,
            "member_summary_total_direct_sponsor"=> 0,
            "member_summary_total_direct_sponsor_sales"=> 0,
            "member_summary_total_group" => 0,
            "member_summary_total_group_sales" => 0,
            "member_summary_capital" => 0,
		);
        return $this->db->insert("member_summary",$data);
	}
	function update_member_own_summary(){
		$sql = "update member_summary
				join (
					select member_id, member_capital as total_capital from member
					where member_id = '".$this->member_id."'
					and member_status <> 9
				) a on member_summary_memberid = member_id
				set member_summary_capital = total_capital";
		return $this->db->query($sql);
	}
	function get_member_summary(){
		$this->db->where('member_summary_memberid',$this->member_summary_memberid);
        return $this->db->get("member_summary")->row_array();
	}
	function update_direct_active_downline(){
		$this->db->set("member_summary_total_active_downline","member_summary_total_active_downline"+1,false);
		$this->db->where('member_summary_memberid',$this->member_summary_memberid);
		$this->db->update('member_summary');
	}
	function update_direct_sponsor_summary(){
		$sql = "update member_summary
				join (
				select member_sponsor_id, sum(case when member_capital > 0 then 1 else 0 end) total_sponsor,
					sum(member_summary_capital) total_sponsor_sales
				from member
				join member_summary on member_summary_memberid = member_id 
				where member_sponsor_id = '".$this->member_sponsor_id."'
				and member_status = 1
				group by member_sponsor_id
				) a on member_summary_memberid = member_sponsor_id
				set member_summary_total_direct_sponsor = total_sponsor,
					member_summary_total_direct_sponsor_sales = total_sponsor_sales";
		return $this->db->query($sql);
	}
	function update_group_sales_summary(){
		$sql = "update member_summary
				join (
				select s.member_id, sum(case when d.member_capital > 0 then 1 else 0 end) total_group,
				sum(member_summary_capital) total_group_sales
				from member s
				join member d on concat(d.member_sponsor_structure,'|') like concat(s.member_sponsor_structure,'|',s.member_id,'|%')
				join member_summary on member_summary_memberid = d.member_id 
				where s.member_id in (
					select member_sponsor_level_memberid from member_sponsor_level where member_sponsor_level_sponsor_id = '".$this->member_id."')
				group by s.member_id

				) a on member_summary_memberid = member_id
				set member_summary_total_group = total_group,
					member_summary_total_group_sales = total_group_sales";
		return $this->db->query($sql);
	}
	function update_member_ranking(){
		$sql = "select member_id, ifnull(cur.ranking_id,0) old_ranking, ifnull(act.ranking_id,0) new_ranking from member m
				join member_summary on member_summary_memberid = member_id
				left join ranking cur on ranking_id = member_ranking
				left join ranking act on act.ranking_status = 1 and act.ranking_min_capital <= member_summary_capital  and act.ranking_min_group_sale_qualified <= member_summary_total_group_sales and act.ranking_min_direct_sale_qualified <= member_summary_total_direct_sponsor_sales
				left join ranking chk on chk.ranking_id = act.ranking_sponsor_ranking
				where member_id in (select member_sponsor_level_sponsor_id from member_sponsor_level where member_sponsor_level_memberid = '".$this->member_id."')
				and act.ranking_min_direct_sponsor <= (select count(1) from member r 
															join ranking rr on rr.ranking_id = r.member_ranking where r.member_sponsor_id = m.member_id)
				order by member_id desc";
		$member_list = $this->db->query($sql)->result_array();
		if($member_list){
			$process_member_id = 0;
			foreach($member_list as $member){
				if($process_member_id == $member['member_id']){
					continue;
				}
				$sql = "select * from member where member_id = ".$member['member_id']." for update";
				$member_info = $this->db->query($sql)->row_array();
				if(!$member_info){
					return -1;
				}
				if($member_info['member_allow_downgrade_ranking']=='Y')
				{
						$data = array(
						
						"member_upgrade_ranking_memberid" => $member['member_id'],
						"member_upgrade_ranking_old_rankingid" => $member['old_ranking'],
						"member_upgrade_ranking_rankingid" =>  $member['new_ranking'],
						"member_upgrade_ranking_updated_date" => date('Y-m-d H:i:s'),
					);
					$status = $this->db->insert("member_upgrade_ranking",$data);
					if(!$status){
						return -1;
					}

					$data = array(
						"member_ranking" => $member['new_ranking']
					);
					$this->db->set($data);
					$this->db->where('member_id',$member['member_id']);
					$status = $this->db->update("member");
					if(!$status){
						return -1;
					}
				}
				
				$process_member_id = $member['member_id'];
			}
		}else{
			return 0;
		}
		return 1;
	}
	function get_group_active_by_date()
	{
		$this->db->where('group_active_date',$this->group_active_date);
		$this->db->where('group_active_status',1);
		return $this->db->get('group_active')->row_array();
	}
	function update_active_group_by_memberid()
	{
		$this->db->set("member_group_active",$this->member_group_active);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member');
	}
	function get_group_active_by_type()
	{
		$this->db->where('group_active_type',$this->group_active_type);
		$this->db->where('group_active_status',1);
		return $this->db->get('group_active')->row_array();
	}
	function get_list_by_group_active()
	{
		$this->db->where('member_group_active',$this->member_group_active);
		$this->db->where('member_status',1);
		return $this->db->get('member')->result_array();
	}
	function get_all_star_manager_list($limit_from_memberid=0,$limit_to_memberid=0)
	{	
		$this->db->join('member_detail','member_detail_memberid = member_id','left');
		$this->db->select('member_id,member_ranking,member_sponsor_structure,member_detail_memberid');
		// $this->db->where('member_detail_rank_bonus_calculate',$this->member_detail_rank_bonus_calculate);
		// $this->db->where('member_ranking >=',$this->member_ranking);
		$this->db->where('member_id',$this->member_id);
		$this->db->where('member_status',1);
		//$this->db->limit('10000');
		// if($limit_from_memberid >0 && $limit_to_memberid>0)
		// {
		// 	$this->db->where('member_id>=',$limit_from_memberid); 
  //   		$this->db->where('member_id<',$limit_to_memberid); 
		// }elseif($limit_to_memberid==0){
		// 	$this->db->where('member_id>=',$limit_from_memberid); 
		// }
		return $this->db->get('member')->row_array();
	}
	function get_downline_list_without_status(){
		
		$this->db->select(" member_id,member_username,member_ranking,member_status, SUM(member_capital) as total");
		$this->db->where_in("member_sponsor_id" , $this->member_sponsorid_list);
		$this->db->group_by("member_id");
		return $this->db->get("member")->result_array();
	}	
	function update_rank_bonus_calculate_status()
	{
		$data = array(
			"member_detail_rank_bonus_calculate"=>$this->member_detail_rank_bonus_calculate,
			);
		$this->db->where('member_detail_memberid',$this->member_detail_memberid);
		$this->db->update('member_detail',$data);
		return $this->db->affected_rows();
	}
	function get_all_higher_ranking_by_memberid()
	{
		//$this->db->select('member_ranking, count(*) as total');
		$this->db->where('member_ranking',$this->member_ranking);
		$this->db->where_in('member_id',$this->sponsor_array);
		$this->db->where_not_in('member_id','-');
		$this->db->order_by('member_id','desc');
		// $this->db->group_by('member_ranking');
		return $this->db->get('member')->result_array();
	}
	function get_member_by_ranking_id(){

		$this->db->where('member_ranking',$this->member_ranking);
		$this->db->where_in('member_id',$this->sponsor_array);
		$this->db->where_not_in('member_id','-');
		$this->db->order_by('member_id','desc');
		return $this->db->get('member')->result_array();
	}
	function get_count_by_upline_ranking()
	{
		$this->db->select('count(*) total');
		$this->db->where('member_ranking>',$this->member_ranking);
		$this->db->where_in('member_id',$this->check_upline_array);
		$this->db->where_not_in('member_id','-');
		return $this->db->get('member')->row_array();
	}
	function update_daily_login_bonus()
	{
		$data = array(

			'member_detail_daily_login_bonus'=>$this->member_detail_daily_login_bonus,
			);
		$this->db->where('member_detail_memberid',$this->member_detail_memberid);
		$this->db->update('member_detail',$data);
	}
	function reset_member_daily_login_status()
	{
		$sql = "update member_detail set member_detail_daily_login_bonus = 0";
		return $this->db->query($sql);
	}
	function update_member_empty_acc_by_memberid()
	{
		$data = array(

			'member_is_empty_acc'=>$this->member_is_empty_acc,
			);
		$this->db->where('member_id',$this->member_id);
		$this->db->update('member',$data);
	}
	function admin_site_login(){
		$this->db->join("member_detail","member_detail_memberid = member_id","left");
		$this->db->where('member_id', $this->member_id);
		$memberDetail  = $this->db->get('member')->row_array();
		if($memberDetail['member_status'] == 1){
			return $memberDetail;
		}
		return false;
	}
	function get_detail_by_like_sponsor_structure()
	{
		$result = $this->db->query("SELECT * from member where member_status = 1 
			and (member_sponsor_structure = ".$this->db->escape($this->direct_sponsor_structure)."
				OR member_sponsor_structure LIKE '%".$this->db->escape_like_str($this->member_sponsor_structure)."%' ESCAPE '!')")->result_array();
		return $result;
	}
	function get_count_member_sponsor_ranking(){

		$this->db->select('count(*) total');
		$this->db->where('member_ranking>=',$this->member_ranking);
		$this->db->where('member_sponsor_id',$this->member_sponsor_id);
		$this->db->where('member_status',$this->member_status);
		return $this->db->get('member')->row_array();
	}
	function create_log_api(){

	    $data = array(
	        'log_api_url' => $this->log_api_url ,
	        'log_api_post' => $this->log_api_post ,
	        'log_api_respond' => $this->log_api_respond,
	        'log_api_orderid' => $this->log_api_orderid,
	        'log_api_token' => $this->log_api_token,
	        'log_api_result_number'=>$this->log_api_result_number,
	        'log_api_created_date' => date('Y-m-d H:i:s')
	    );
	    $this->db->insert('log_api', $data);
	    $member_id = $this->db->insert_id();
		return $member_id;
  	}
  	function update_log_api_respond_by_id()
  	{
  		$data = array("log_api_respond"=>$this->log_api_respond);
  		$this->db->where('log_api_id',$this->log_api_id);
  		return $this->db->get('log_api')->row_array();
  	}
  	function get_log_api_by_token()
  	{
  		$this->db->where('log_api_token',$this->log_api_token);
  		return $this->db->get('log_api')->row_array();
  	}
	function get_member_detail_api_p2p_list_by_status()
	{
		$this->db->join('member','member_id = member_detail_memberid','left');
		$this->db->where('member_detail_register_api_p2p_status',$this->member_detail_register_api_p2p_status);
		$this->db->limit(1000);
		// $this->db->where('member_id>',100);
		$this->db->order_by('member_id','asc');
		return $this->db->get('member_detail')->result_array();
	}
	function update_registet_api_p2p_by_memberid()
	{
		$data= array("member_detail_register_api_p2p_status"=>$this->member_detail_register_api_p2p_status);
		$this->db->where('member_detail_memberid',$this->member_detail_memberid);
		$this->db->update('member_detail',$data);
	}
	function get_member_detail_api_oc_list_by_status()
	{
		$this->db->join('member','member_id = member_detail_memberid','left');
		$this->db->where('member_detail_register_api_oc_status',$this->member_detail_register_api_oc_status);
		$this->db->limit(1000);
		// $this->db->where('member_id>',100);
		$this->db->order_by('member_id','asc');
		return $this->db->get('member_detail')->result_array();
	}
	function update_registet_api_oc_by_memberid()
	{
		$data= array("member_detail_register_api_oc_status"=>$this->member_detail_register_api_oc_status);
		$this->db->where('member_detail_memberid',$this->member_detail_memberid);
		$this->db->update('member_detail',$data);
	}*/
}