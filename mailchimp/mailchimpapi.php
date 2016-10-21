<?php
include 'MCAPI.class.php';

$apikey = $config['mailchimp_api_key'];
$listId = $config['mailchimp_list_id'];
$campaignId = 'YOUR MAILCHIMP CAMPAIGN ID - see campaigns() method';
$boss_man_email = $my_email = $email;
$apiUrl = 'http://api.mailchimp.com/1.2/';

$api = new MCAPI($apikey);
				
$merge_vars = array('FNAME'=> $username, 'LNAME'=> $fullname);

$retval = $api->listSubscribe( $listId, $my_email, $merge_vars );

?>
