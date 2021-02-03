<?php

class Package_mobile extends CI_Model
{

  var $order_payment_trx_number =0,
    $order_payment_type = "",
    $order_payment_customer_no = "",
    $order_payment_phone_mobile = "",
    $order_payment_email ="",
    $order_payment_usdt_address ="",
    $order_payment_amount ="",
    $order_payment_status ="";

  /*function get_payment_type_list()
  {
    $this->db->where('payment_type_type',$this->payment_type_type);
    return $this->db->get('payment_type')->result_array();
  }
  function get_bank_code_list()
  {
    return $this->db->get('bank_code')->result_array();
  }
  function get_sales_report()
  {
    return $this->db->get('order-payment')->result_array();
  }
  function create_order_payment_trx(){

      $order_payment_trx_number = $this->generate_no();
      $data = array(
         
          'order_payment_trx_number' => $order_payment_trx_number,
          'order_payment_type' => $this->order_payment_type,
          'order_payment_customer_no' => $this->order_payment_customer_no,
          'order_payment_phone_mobile' => $this->order_payment_phone_mobile,
          'order_payment_email' => $this->order_payment_email,
          'order_payment_usdt_address' => $this->order_payment_usdt_address,
          'order_payment_amount' => $this->order_payment_amount,
          'order_payment_created_date' => date('Y-m-d H:i:s'),
          'order_payment_status' => $this->order_payment_status
     
      );
      $this->db->insert('order_payment', $data);
      $new_id = $this->db->insert_id();
      return $new_id;
    }
    function check_random_customer_name()
    {
      $this->db->where('order_payment_customer_no',$this->order_payment_customer_no);
      return $this->db->count_all_results('order_payment');
    }
    function get_order_payment_byid()
    {
      $this->db->join('payment_type','payment_type_id = order_payment_type','left');
      $this->db->where('order_payment_id',$this->order_payment_id);
      return $this->db->get('order_payment')->row_array();
    }
    function get_bank_code_item($id=1)
    {
      //$this->where('bank_code_id',$id);
      //return $this->db->get('bank_code')->row_array();
      $this->db->select("bank_code_value");
      $this->db->where('bank_code_id',$id);
      return $this->db->get("bank_code")->row_array(); 
      

    }
    function get_email_content_item($id=1)
    {
      
      $this->db->select("payment_type_value");
      $this->db->where('payment_type_id',$id);
      return $this->db->get("payment_type")->row_array(); 
        

    }
    function check_email_resource_type($id=1)
    {
      $this->db->select("payment_type_type");
      $this->db->where('payment_type_id',$id);
      return $this->db->get("payment_type")->row_array(); 

    }
    function generate_no($length=6)
    {
      $characters = '1234567890';
      $charactersLength = strlen($characters);
      $value['total']=1;
      while($value['total']!=0){
        
           $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          $randomString ="INV".$randomString;
                
          $this->db->select("count(*) as total");
          $this->db->where("order_payment_trx_number",$randomString);
          $value = $this->db->get("order_payment")->row_array(); 
                  
      }
      return $randomString;
    }
    function all_for_sales($limit = 0){
      //search option
      $this->db->join('payment_type','payment_type_id= order_payment_type','left');
      if(($this->search_start_date)&&($this->search_end_date)){
        $this->db->where('order_payment_created_date
        BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
        AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
      }
      if(($this->search_start_date)&&(!$this->search_end_date)){
        $search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
        $this->db->where('order_payment_created_date>=', $search_start_date);
      }
      if((!$this->search_start_date)&&($this->search_end_date)){
        $search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
        $this->db->where('order_payment_created_date>=', $search_end_date);
      }
      if($this->order_payment_trx_no)
      {
        $this->db->where('order_payment_trx_number', $this->order_payment_trx_no);
      }
      // $this->db->where('order_payment_status','1');
      $this->db->order_by('order_payment_created_date', 'DESC');
      $this->db->limit($limit);
      $this->db->offset($this->offset);
      return $this->db->get('order_payment')->result_array();;
    }
    function count_for_sales(){
      //search option
       if(($this->search_start_date)&&($this->search_end_date)){
        $this->db->where('order_payment_created_date
        BETWEEN "'. date('Y-m-d H:i:s', strtotime($this->search_start_date)).'" 
        AND "'. date('Y-m-d 23:59:59', strtotime($this->search_end_date)).'"');
      }
      if(($this->search_start_date)&&(!$this->search_end_date)){
        $search_start_date=date('Y-m-d H:i:s', strtotime($this->search_start_date));
        $this->db->where('order_payment_created_date>=', $search_start_date);
      }
      if((!$this->search_start_date)&&($this->search_end_date)){
        $search_end_date=date('Y-m-d H:i:s', strtotime($this->search_end_date));
        $this->db->where('order_payment_created_date>=', $search_end_date);
      }
      if($this->order_payment_trx_no)
      {
        $this->db->where('order_payment_trx_number', $this->order_payment_trx_no);
      }
      // $this->db->where('order_payment_status','1');
      return $this->db->count_all_results('order_payment');   
    }
    function update_order_payment_status_by_id()
    {
      $data = array('order_payment_status'=>$this->order_payment_status);
      $this->db->where('order_payment_id',$this->order_payment_id);
      $this->db->update('order_payment',$data);
    }*/
}