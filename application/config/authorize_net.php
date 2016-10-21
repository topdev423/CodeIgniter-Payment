<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Authorize.net Account Info get to Config file
$Auth_Details=unserialize(API_LOGINID); 

// Authorize.net Account Setting Info get to Config file
$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

// Authorize.net Account Info
$config['api_login_id'] = $Auth_Setting_Details['Login_ID'];
$config['api_transaction_key'] = $Auth_Setting_Details['Transaction_Key'];

// ARB URL

if($credit_type == 'recurring'){
	if(strtolower($Auth_Setting_Details['mode']) == 'sandbox'){
		$config['arb_api_url'] = 'https://apitest.authorize.net/xml/v1/request.api'; // TEST URL
	}else{
		$config['arb_api_url'] = 'https://api.authorize.net/xml/v1/request.api'; // PRODUCTION URL
	}	
}elseif($credit_type == 'payment'){
	if(strtolower($Auth_Setting_Details['mode']) == 'sandbox'){
		$this->api_url = 'https://test.authorize.net/gateway/transact.dll'; 	//sandbox Where we postin' to?
	}else {
		$this->api_url = 'https://secure.authorize.net/gateway/transact.dll';	// live Where we postin' to?
	}
}



/* EOF */
