<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Function
{
	
	public function __construct()
	{
		
		$CI =& get_instance();
	}
	
	function currency_format($value, $decimal = DECIMAL_POINT){
		if(is_numeric($value))
			$value = number_format($this->to_decimal_digit($value,$decimal), $decimal, '.', ',');
		else{
			$value = 'err';
		}
		return $value;
	}
	function to_decimal_digit($amount, $digit){
		return substr(sprintf("%.".(++$digit)."f", $amount), 0, ($digit>1?-1:-2));
	}
	function show_profiler()
	{
		$CI =& get_instance();
		if(defined('ENVIRONMENT'))
		{

			switch (ENVIRONMENT)
			{
				case "staging":

				 $CI->output->enable_profiler(FALSE);
				  break;
		
				case "development":
				 $CI->output->enable_profiler(true);
				  break;

			default:

				$CI->output->enable_profiler(FALSE);
				 break;
			}
		}
	}
	function signature($source)
	{
		return base64_encode(hex2bin(sha1($source)));
	}
	function hex2binsignature($hexSource)
	{
		if (!function_exists('hex2bin'))
		{
			
			for ($i=0;$i<strlen($hexSource);$i=$i+2)
			{
				$bin .= chr(hexdec(substr($hexSource,$i,2)));
			}
			return $bin;
		}
	}
    function generate_signature($array)
    {
    	// ksort($array);
		$string = '';
		foreach($array as $akey=>$avalue){
			if($akey!='signatrue'){
				$string  .= $avalue;
			}
		}
		$sign = md5($string);
		// echo $sign;
		// $sign = base64_encode($hash);
		return $sign;
	}
	function generateRandomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	function get_client_ip_address(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	function generate_64base_image($path){
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		return $base64;
	}
	function curl($url, $param, $header=array())
    {
        $opt = curl_init();
        curl_setopt($opt,CURLOPT_URL,$url);
        curl_setopt($opt,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($opt,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($opt,CURLOPT_VERBOSE, true);
        curl_setopt($opt,CURLOPT_HEADER, true);
        curl_setopt($opt,CURLOPT_POST,true);
        curl_setopt($opt,CURLOPT_POSTFIELDS,$param);
        if($header){
        	curl_setopt($opt, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($opt, CURLOPT_HEADER, 0);
        curl_setopt($opt, CURLOPT_COOKIEFILE, "/tmp/cookies.txt");
        curl_setopt($opt, CURLOPT_COOKIEJAR, "/tmp/cookies.txt");
        $respond = curl_exec($opt);
        curl_close($opt);
        return $respond;

	}
	function buildAutoSubmitForm($sRequestURL, $sHTTPMethod, $aFormParams) {
		// action 是JRDiDi系统的下单请求API地址
		// method='POST' 使用POST方法提交
		// method='GET' 使⽤GET方法提交
		// target='_blank' 在用户浏览器中新开标签页打开下单页面
		$sHtml = "<form id='jrdidi_submit' name='jrdidi_submit' action='". $sRequestURL ."' method='" . $sHTTPMethod. "'>";
		// 将所有参数都拼装成form表单待提交的参数
		foreach ($aFormParams as $key => $value) {
			$value = str_replace("'", "&apos;", $value);
			$sHtml.= "<input type='hidden' name='".$key."' value='".$value."'/>";
		}
		//submit按钮控件请不要含有name属性
		$sHtml = $sHtml."<input type='submit' value='ok' style='display:none;''></form>";
		// ⽤用JavaScript自动提交form表单
		$sHtml = $sHtml."<script>document.forms['jrdidi_submit'].submit();</script>";

		return $sHtml;
	}
}