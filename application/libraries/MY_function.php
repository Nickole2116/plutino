<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Function
{
    public function __construct()
	{
		
		$CI =& get_instance();
    }
    function log_encrypt_string($pwd_plain)
    {
        /**
         * LOGIN ENCRYPTION - AES-128-CTR
         */
        $ciphers = "AES-128-CTR";

        //Use OpenSSL Encryption method
        $iv_length = openssl_cipher_iv_length($ciphers);
        $options = 0;

        // Non-NULL Initialization Vector for Encryption
        $encryption_iv = '1029384756019273';

        // Store the Encryption key
        $encryption_key = SALT ;

        // FINAL Encryption
        $encryption = openssl_encrypt($pwd_plain,$ciphers,$encryption_key,$options,$encryption_iv);
        return $encryption;
        
    }

    function log_decrypt_string($pwd_encrypt)
    {
        $ciphers = "AES-128-CTR";
        $decryption_key = SALT;
        $options = 0;
        $decryption_iv = '1029384756019273';

        // FINAL Decryption
        $decryption = openssl_decrypt($pwd_encrypt,$ciphers,$decryption_key,$options,$decryption_iv);
        return $decryption;

    }
}


?>