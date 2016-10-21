<?php
define('SITE_COMMON_DEFINE','fancyy-');

$dir = "css/site/";
$files = glob($dir."*.css");
foreach ($files as $file) { 
	unset($fileChk);
	$fileChk = explode('fancyy-',$file); 
	if(count($fileChk)>1) {
		$file.$newFile = str_replace('fancyy-',SITE_COMMON_DEFINE,$file);
		rename($file,$newFile);
	}
}
die;
?>