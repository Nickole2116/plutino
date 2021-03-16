<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __contruct()
	{
		//parent::__contruct();
		$this->load->model("welcome_mod","welcome");
		$this->index();

		//parent::__contruct();
	}
	public function index()
	{
		//$this->load->view('member/coming_soon');
		//$this->output->enable_profiler(TRUE);
		$status = $this->session->userdata('members');
		$load = $this->session->userdata('status');
		if($load =="1")
		{
			redirect('member');
		}else 
		{
			$this->login();

		}


	}
	public function test()
	{

		$data = array();
		$data['test'] = "Testing 123";
		$data['test2'] = "Testing 2";
		$this->load->view('member/login',$data); //CALL VIEW

	}

	public function login()
	{
		$data = array();
		$this->load->view('member/login',$data);
		//$this->output->enable_profiler(TRUE);
		
	}

	public function p_login()
	{
		$this->load->model("welcome_mod","welcome");
		//$helper = $this->load->helper('MY_functions');

		$username = $this->input->post('txtusername');
		$password = $this->input->post('txtpassword');


		$data = array();
		$welcome = new $this->welcome();
		$credentials = $welcome->p_member_login($username,$password);
		/**SET SESSION ID */
		$this->session->set_userdata('members',$credentials);
		//$this->session->set_userdata('status','1');


		if($credentials != "0")
		{
			$this->session->set_userdata('status','1');

			redirect('member/home',$data);

			
		}else 
		{
			$this->load->view('member/err_login',$data);
			$this->session->set_userdata('status','0');


		}

		
		//$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);

		
	}

	public function p_login_mb()
	{
		$this->load->model("welcome_mod","welcome");
		//$helper = $this->load->helper('MY_functions');

		$username = $this->input->post('txtname_mb');
		$password = $this->input->post('txtpassword_mb');


		$data = array();
		$welcome = new $this->welcome();
		$credentials = $welcome->p_member_login($username,$password);
		/**SET SESSION ID */
		$this->session->set_userdata('members',$credentials);
		//$this->session->set_userdata('status','1');

		//echo $credentials;


		if($credentials == 0)
		{
			$this->load->view('member/err_login',$data);
			$this->session->set_userdata('status','0');

			
			
		}else 
		{
			$this->session->set_userdata('status','1');

			redirect('member/home',$data);



		}

		
		//$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);
				//$this->output->enable_profiler(TRUE);


		
	}


	public function register()
	{
		$data = array();
		$this->load->view('member/register',$data);
		//$this->output->enable_profiler(TRUE);

	}

	public function p_register()
	{
		$this->load->model("welcome_mod","welcome");

		$username = $this->input->post('txtusernamer');
		$password = $this->input->post('txtpasswordr');

		$data = array();

		$welcome = new $this->welcome();
		$credentials = $welcome->p_member_register($username,$password);
		//echo $credentials;
		/**SET SESSION ID */
		$this->session->set_userdata('members',$credentials);

		redirect('member');
		
		//$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);

		
	}

	public function p_register_mb()
	{
		$this->load->model("welcome_mod","welcome");

		$username = $this->input->post('txtnamer_mb');
		$password = $this->input->post('txtpasswordr_mb');

		$data = array();

		$welcome = new $this->welcome();
		$credentials = $welcome->p_member_register($username,$password);
		//echo $credentials;
		/**SET SESSION ID */
		$this->session->set_userdata('members',$credentials);

		redirect('member');

		
		//$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);

		
	}

	public function logout()
	{
		$this->session->set_userdata('members',0);
		redirect('welcome/login');
	}


	/**
	 * **************************************
	 * ADMIN LOGIN CONTROLLERS
	 * **************************************
	 */

	public function m_login()
	{
		$data = array();
		$this->load->view('admin/login',$data);
		$this->output->enable_profiler(TRUE);
		
	}

	public function admin_login()
	{
		$this->load->model("welcome_mod","welcome");

		$username = $this->input->post('txtusername_admin');
		$password = $this->input->post('txtpassword_admin');


		$data = array();
		$welcome = new $this->welcome();
		$admin_credentials = $welcome->p_admin_login($username,$password);
		/**SET SESSION ID */
		$this->session->set_flashdata('admins',$admin_credentials);
		
		$this->load->view('admin/admin_listings',$data);
		$this->output->enable_profiler(TRUE);

		
	}
}
