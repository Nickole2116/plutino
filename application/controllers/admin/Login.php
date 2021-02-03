<?php
class Login extends MX_Controller{
    public function __construct(){

        parent::__construct();
        $this->load->module("admin_modules");
      
        $this->my_function->show_profiler(); 
        $this->lang->load('content_lang', 'chinese'); //english
       
	}
	function index(){
        
        $data = array();
        $this->load->view("module/admin/template/header_login", $data);
        $this->load->view("module/admin/login", $data);
        $this->load->view("module/admin/template/footer_login", $data);

    }
    
    function p_login()
    {
        $data = array();
        $data = $this->admin_modules->p_login();
        $this->index();
    }   

    function logout()
    {

        $data = array();
        $data = $this->admin_modules->p_logout();
        // $data['content'] = "admin/login";
        // $this->load->view("template/admin_template/admin_default", $data);
    
    }
    
}
