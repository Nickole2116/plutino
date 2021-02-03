<?php
class Cron extends MX_Controller{

	 function __construct(){

		parent::__construct();
		
		$this->load->module('package_modules');
		$this->my_function->show_profiler(); 
	}
	/*used for disney*/
	function api_check_balance()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_check_balance();
	}
	function api_airtime_bill()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_airtime_bill();
	}
	function api_airtime_ereload()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_airtime_ereload();
	}
	function api_airtime_softpin()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_airtime_softpin();
	}
	function api_reload_evoucher()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_reload_evoucher();
	}
	function api_reload_mobile()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_reload_mobile();
	}
	function api_check_transaction_status()
	{
		$this->output->enable_profiler(TRUE);
		$this->package_modules->api_check_transaction_status();
	}
}