<?php

class Announcement extends MY_Controller{
    
    public function __construct(){
    	
      $this->my_function->show_profiler(); 
       
      $method = $this->router->method;

      if($method != 'page' &$method != 'page/p_login' && $method != 'page/check_forget_password' && $method != 'page/forget_password' && 
      $method != 'page/reset_password' && $method != 'page/update_reset_password' && $method != 'page/reset_password_successful' && $method != 'language_select'){
    
        if(!$this->session->userdata('member_id'))
        { 
          if($this->session->userdata('member_isfirst_login')=='Y')
          {
             redirect("member/profile"); 
          }else{
            redirect("page"); 
          }
        }
     }

    }
    function index(){
		$data = array();
        
		$data['content'] = "member/announcement";
		//$this->load->view("template/".CURRENT_TEMPLATE, $data);
        
        $this->load->view("member/template/default", $data);

    }




}
