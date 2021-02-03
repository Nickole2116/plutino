<?php
class Admin extends MX_Controller{
    
    public function __construct(){

        parent::__construct();
      
        $this->load->module("admin_modules");
        $this->load->module("wallet_modules");
        $this->load->module("bonus_modules");
        $this->load->module("member_modules");
      
        $this->my_function->show_profiler(); 
    
        //$this->output->enable_profiler(TRUE);
        $this->load->library('encrypt');

        $method = $this->router->method;

        if($method != 'login' && $method != 'p_login' && $method != 'logout'  )
        {       
            if(!$this->session->userdata('admin_id'))
            {
                redirect(ADMINPATH."/login");  
            }
            // check session

            if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data['content'] = "admin/login";
                $this->load->view("module/admin/template/default", $data);
            }
            if($this->session->userdata('admin_role')=="2"){
                redirect(ADMINPATH.'/member');
            }
        }
        $language_select=$this->session->userdata('language_select');
  
        if (!$language_select){ //check the language_select or not
          $language_selected='chinese';
        }
        else if($language_select=='1'){
          $language_selected='english';
        }
        else if($language_select=='2'){
          $language_selected='chinese';
        }
        $this->lang->load('content_lang', $language_selected); //english
        $this->session->set_userdata('language_selected', $language_select);

    }
    
    public function index(){

       $this->admin();
    }
   
    public function admin(){
        //pagination
        $data = $this->admin_modules->get_listing();
        $additional_variable = $data['additional_variable'];
        $data['admin'] = $data['admin_show'];
        $data['offset'] = $data['offset'];

        $config['total_rows'] = $data['total_rows'];
        $config['base_url'] = $this->config->item('base_url').ADMINPATH."/admin/index/?".$additional_variable;
        $config['per_page'] =PER_PAGE_LIMIT;

        $config['title']  = "";
        
        $data['title'] = 'Admin';
        $data['page_header'] = 'admin';
        $data['pagination'] = $this->my_pagination->normalConfiguration($config);
        //$data['under_maintenance'] = $this->member_modules->get_latest_under_maintenance();

        $data['admin_role'] = $this->my_constant->admin_role();
        $data['content'] = "module/admin/listing";
        $data['content1'] = "module/admin/form";
        
        $this->load->view("module/admin/template/default", $data);
    }
  
    function p_login()
    {
        $data = array();
        $data = $this->admin_modules->p_login();
        $this->login();

    }   

    function p_create()
    {

        $data = array();
        $data =$this->admin_modules->p_create();
        if($data['error'] != 1){

            redirect(ADMINPATH.'/admin');
        }
        $this->admin();
        
    }

    function p_update(){


        $data= array();
        $data = $this->admin_modules->p_update();
        if($data['error'] != 1){

            redirect(ADMINPATH.'/admin');
        }
       
        $this->admin();
    }

    function p_update_password(){

        $data = array();
        $admin = $this->admin_modules->p_update_password();
        if($data['error'] != 1){

            redirect(ADMINPATH.'/admin');
        }
        $this->admin();

    }

     function p_update_status()
    {

        $data = array();
        $data = $this->admin_modules->p_update_status();

    }

    function logout()
    {

        $data = array();
        $data = $this->admin_modules->p_logout();
        // $data['content'] = "admin/login";
        // $this->load->view("template/admin_template/admin_default", $data);
    
    }
    
    function ajax_process(){
        $this->admin_modules->get_ajax_result();
    }
    function p_update_maintenance(){
        $data = $this->member_modules->under_maintenance_update();
        redirect(ADMINPATH.'/admin');
    }
    function language_select()
    {
      $language_select=strtolower($this->input->get_post("language_select"));
      $current_url=$this->input->get_post("current_url");
      $this->session->set_userdata('language_select', $language_select);
      redirect($current_url);
    }
}