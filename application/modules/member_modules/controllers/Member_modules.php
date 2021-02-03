<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Member_modules extends MX_Controller
{
	var $is_admin = 0;
	 function __construct(){

		parent::__construct();
		
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

		$this->load->model("member_mod","member");
		$this->load->model("package_mod","package");
		// $this->load->model("package_mobile", "mobile");
		
	}
	function validate_form($form){

		switch ($form) {
			
			case 'upgrade_ranking':
				
				break;
			default:
	
		}
	}
	
}