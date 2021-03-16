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
		$members_id = $this->session->userdata('members');
		$this->load->model("welcome_mod","welcome");
		$welcome = new $this->welcome();
		$data = array();
		$data['list'] = $welcome->all_posts();
		$data['user'] = $welcome->get_user($members_id);
		$this->load->view('member/home',$data);
		//$this->output->enable_profiler(TRUE);

	}


	public function posts()
	{
		
		$data = array();
		$this->load->view('member/posts',$data);
	}

	public function p_posts()
	{
		$this->load->model("welcome_mod","welcome");
		//$helper = $this->load->helper('MY_functions');

		$posts_msg = $this->input->post('posts_content');
		//$posts_created_date = $this->input->post('txtpassword');
		$planets_id = $this->input->post('planet_type');
		$members_id = $this->session->userdata('members');
		$posts_likes = 0;

		$welcome = new $this->welcome();
		$log = $welcome->add_posts($posts_msg,$planets_id,$members_id);

		if(!empty($log))
		{
			redirect('member/home');
		}else
		{
			$data = array();
			$this->load->view('member/posts',$data);

		}
		
		
	}

	public function p_likes()
	{
		$this->load->model("welcome_mod","welcome");
		$counts = $this->input->post('counts');
		//$posts_created_date = $this->input->post('txtpassword');
		$pid = $this->input->post('pid');
		
		$welcome = new $this->welcome();
		$log = $welcome->like_post($counts,$pid);

		if($log == "yes")
		{
			echo "liked";

		}else 
		{
			echo "no";

		}

		//$data = array();
		//$this->load->view('member/home',$data);
	}

	

	public function p_comment()
	{

	}

	public function logout()
	{

	}


	
}
