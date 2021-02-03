<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Constant 
{
	public $CI;
	function all_language()
	{

		$all_language = array(
			"1" => "English",
			"2" => "中文"
		);

		return $all_language;
	}

	function admin_role(){
		$privilege = array(
			"0" => lang('boss'),
			"1" => lang('admin'),
			"2" => lang('finance'),
		);
		return $privilege;
	}

}