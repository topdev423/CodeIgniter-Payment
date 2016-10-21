<?php
$consumer_key=$this->config->item('google_client_id');
$consumer_secret=$this->config->item('google_client_secret');
$callback=base_url().'site/user/find_friends_gmail_callback';
$emails_count='500';
?>