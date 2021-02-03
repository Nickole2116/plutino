<?php

class Member extends MX_Controller{
    
    public function __construct(){

      parent::__construct();

      $this->load->module("member_modules");
      $this->load->module("package_modules");

    // $this->my_function->show_profiler(); 
      $method = $this->router->method; 
      $this->templateStyle = "postlogin";
      $language_select=$this->session->userdata('language_select');

      // if (!$language_select){ //check the language_select or not
      //   $language_selected='chinese';
      // }
      // else if($language_select=='1'){
        $language_selected='english';
      // }
      // else if($language_select=='2'){
      //   $language_selected='chinese';
      // }
      $this->lang->load('content_lang', $language_selected); //english
      $this->session->set_userdata('language_selected', $language_select);

    } 
    function index()
    {
      $phone_credit = $this->package_modules->get_payment_type_list(2);
      $data['phone_ereload_credit'] = $phone_credit;

      $phone_credit2 = $this->package_modules->get_payment_type_list(1);
      $data['phone_softpins_credit'] = $phone_credit2;

      $bill_credit = $this->package_modules->get_payment_type_list(3);
      $data['bill_credit'] = $bill_credit;

      $voucher_credit = $this->package_modules->get_payment_type_list(4);
      $data['voucher_credit'] = $voucher_credit;

      $games_credit = $this->package_modules->get_payment_type_list(5);
      $data['games_credit'] = $games_credit;

      $bank_select = $this->package_modules->get_bank_code_list();
      $data['bank_code'] = $bank_select;

      $data['content'] = "member/home";
      $this->load->view("member/template/default",$data);
    }
    function language_select(){
      $language_select=strtolower($this->input->get_post("language_select"));
      $current_url=$this->input->post("current_url");
      $this->session->set_userdata('language_select', $language_select);
      $this->session->set_flashdata('language_changed', $language_select); 

      redirect($current_url);
    }
    //return from mobile softpins (airtime) - surepay
    function fund_transfer()
    {
      $data = array();
      $data = $this->package_modules->fund_transfer();
      
      $phone_credit = $this->package_modules->get_payment_type_list(2);
      $data['phone_ereload_credit'] = $phone_credit;

      $phone_credit2 = $this->package_modules->get_payment_type_list(1);
      $data['phone_softpins_credit'] = $phone_credit2;

      $bill_credit = $this->package_modules->get_payment_type_list(3);
      $data['bill_credit'] = $bill_credit;

      $voucher_credit = $this->package_modules->get_payment_type_list(4);
      $data['voucher_credit'] = $voucher_credit;

      $games_credit = $this->package_modules->get_payment_type_list(5);
      $data['games_credit'] = $games_credit;

      $bank_select = $this->package_modules->get_bank_code_list();
      $data['bank_code'] = $bank_select;

      $data['content'] = "member/home";
      $this->load->view("member/template/default",$data);
    }

    //return from mobile ereload (airtime) -surepay
    function fund_transfer_ereload()
    {
      $data = array();
      $data = $this->package_modules->fund_transfer_ereload();
      
      $phone_credit = $this->package_modules->get_payment_type_list(2);
      $data['phone_ereload_credit'] = $phone_credit;

      $phone_credit2 = $this->package_modules->get_payment_type_list(1);
      $data['phone_softpins_credit'] = $phone_credit2;

      $bill_credit = $this->package_modules->get_payment_type_list(3);
      $data['bill_credit'] = $bill_credit;

      $voucher_credit = $this->package_modules->get_payment_type_list(4);
      $data['voucher_credit'] = $voucher_credit;

      $games_credit = $this->package_modules->get_payment_type_list(5);
      $data['games_credit'] = $games_credit;

      $bank_select = $this->package_modules->get_bank_code_list();
      $data['bank_code'] = $bank_select;

      $data['content'] = "member/home";
      $this->load->view("member/template/default",$data);
    }
    function returnAPIURI()
    {
      $data = $this->package_modules->returnAPIURI();
    }
    function success_api()
    {
      $this->session->set_flashdata('success',1); 
      redirect('member');
    }
    function fail_api()
    {
      $this->session->set_flashdata('error',1); 
      redirect('member');
    }
    function test()
    {
      $this->package_modules->check_status_transaction('55728882bcf54751ba7c05724c057ca9','30');
    }
}