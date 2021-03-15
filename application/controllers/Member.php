<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

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
		$this->home();

	}

	public function home()
	{
		$data = array();
		$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);

	}


	public function post()
	{

	}

	public function p_comment()
	{

	}

	public function logout()
	{

	}


	
}
