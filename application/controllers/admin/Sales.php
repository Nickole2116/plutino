<?php
class Sales extends MX_Controller{
    public function __construct(){

       parent::__construct();
       
       $this->load->module("package_modules");
       $this->my_function->show_profiler(); 
     
        $method = $this->router->method;

        if($method != 'login' && $method != 'p_login' )
        {       
            if(!$this->session->userdata('admin_id'))
            {
                redirect(ADMINPATH."/login");  
            }
            if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data['content'] = "admin/login";
                $this->load->view("template/".CURRENT_TEMPLATE, $data);
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
    function index()
    {
        $data = $this->package_modules->get_sales_report();   
        $data['sales'] = $data['package_show'];
        $additional_variable = $data['additional_variable'];
        $config['total_rows'] = $data['total_rows'];
        $config['base_url'] = base_url(ADMINPATH."/sales?").$additional_variable;
        $config['per_page'] =PER_PAGE_LIMIT;
        $data['pagination'] = $this->my_pagination->normalConfiguration($config);
        
        $data['title'] = 'Sales';
        $data['page_header'] = 'sale_listing';
        
        $data['content'] = "module/sales/report";
        $data['content1'] = "";
        
        $this->load->view("module/admin/template/default", $data);

    }
}   
?>
